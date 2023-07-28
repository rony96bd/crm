<?php

namespace App\Http\Controllers\User;

use App\Exports\DonorsExport;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Blood;
use App\Models\City;
use App\Models\Donor;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ManageDonorController extends Controller
{

    public function index()
    {
        $ids = json_decode(Auth::guard('user')->user()->manage_agent_id);
        $pageTitle = "Manage Students List";
        $emptyMessage = "No data found";
        $agents = Agent::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::whereIn('agent_id', $ids)->latest()->with('agent')->paginate(getPaginate());
        return view('user.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'agents'));
    }

    public function pending()
    {
        $ids = json_decode(Auth::guard('user')->user()->manage_agent_id);
        $pageTitle = "Pending Students List";
        $emptyMessage = "No data found";
        $donors = Donor::where('status', 0)
        ->whereIn('agent_id', $ids)
            ->latest()->with('agent')->paginate(getPaginate());
        return view('user.donor.index', compact('pageTitle', 'emptyMessage', 'donors'));
    }

    public function approved()
    {
        $ids = json_decode(Auth::guard('user')->user()->manage_agent_id);
        $pageTitle = "Approved Students List";
        $emptyMessage = "No data found";
        $donors = Donor::where('status', 1)
        ->whereIn('agent_id', $ids)
            ->latest()->with('agent')->paginate(getPaginate());
        return view('user.donor.index', compact('pageTitle', 'emptyMessage', 'donors'));
    }

    public function banned()
    {
        $ids = json_decode(Auth::guard('user')->user()->manage_agent_id);
        $pageTitle = "Banned Students List";
        $emptyMessage = "No data found";
        $donors = Donor::where('status', 2)
        ->whereIn('agent_id', $ids)
            ->latest()->paginate(getPaginate());
        return view('user.donor.index', compact('pageTitle', 'emptyMessage', 'donors'));
    }

    public function export()
    {
        //export Donors
        return Excel::download(new DonorsExport, 'students.xlsx');
    }

    public function exportv()
    {
        //export Donors
        $pageTitle = "Manage Students List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $agents = Agent::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::latest()
            ->where('status', 1)
            ->with('blood', 'location', 'agent')->paginate(getPaginate());
        return view('user.donor.exportv', compact('pageTitle', 'emptyMessage', 'donors', 'bloods', 'agents'));
    }

    public function exportpdf($id)
    {
        //export Donors
        $pageTitle = "Students Information";
        $donor = Donor::findOrFail($id);
        return view('user.donor.exportpdf', compact('pageTitle', 'donor'));
    }

    public function getexportpdf($id)
    {
        //export Donors
        $donor = Donor::findOrFail($id);

        $data = ['donor' => $donor];
        $pdf = Pdf::loadView('user.donor.exportpdf', $data);
        return $pdf->download('student' . '_' . $donor['firstname'] . '.pdf');
    }

    public function create()
    {
        $pageTitle = "Student Create";
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        return view('user.donor.create', compact('pageTitle', 'cities', 'bloods'));
    }

    public function donorBloodSearch(Request $request)
    {
        $request->validate([
            'blood_id' => 'required|exists:bloods,id'
        ]);
        $bloodId = $request->blood_id;
        $blood = Blood::findOrFail($request->blood_id);
        $pageTitle = $blood->name . " Blood Group Students List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::where('blood_id', $request->blood_id)->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('user.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods', 'bloodId'));
    }

    public function search(Request $request)
    {
        $pageTitle = "Students Search";
        $emptyMessage = "No data found";
        $search = $request->search;
        $donors = Donor::where('firstname', 'like', "%$search%")->latest()->with('firstname', 'lastname')->paginate(getPaginate());
        return view('user.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'search'));
    }

    public function approvedStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:donors,id'
        ]);
        $donor = Donor::findOrFail($request->id);
        $donor->status = 1;
        $donor->save();
        $notify[] = ['success', 'Students has been approved'];
        return back()->withNotify($notify);
    }

    public function bannedStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:donors,id'
        ]);
        $donor = Donor::findOrFail($request->id);
        $donor->status = 2;
        $donor->save();
        $notify[] = ['success', 'Students has been canceled'];
        return back()->withNotify($notify);
    }


    public function featuredInclude(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:donors,id'
        ]);
        $donor = Donor::findOrFail($request->id);
        $donor->featured = 1;
        $donor->save();
        $notify[] = ['success', 'Include this Students featured list'];
        return back()->withNotify($notify);
    }

    public function featuredNotInclude(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:donors,id'
        ]);
        $donor = Donor::findOrFail($request->id);
        $donor->featured = 0;
        $donor->save();
        $notify[] = ['success', 'Remove this Students featured list'];
        return back()->withNotify($notify);
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|max:80',
            'lastname' => 'required|max:80',
            'whatsapp' => 'required|max:40',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'file' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file2' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file3' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file4' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file5' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file6' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file7' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file8' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file9' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file10' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file11' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file12' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file13' => ['nullable', 'max:2048', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
        ]);

        $donor = new Donor();
        if ($request->hasFile('file')) {
            $fileName = 'passport' . '_' . time() . '.' . $request->file->extension();
            $request->file->move('assets/files/student', $fileName);
        } else {
            $fileName = $donor->file;
        }

        if ($request->hasFile('file2')) {
            $fileName2 = 'CV' . '_' . time() . '.' . $request->file2->extension();
            $request->file2->move('assets/files/student', $fileName2);
        } else {
            $fileName2 = $donor->file2;
        }

        if ($request->hasFile('file3')) {
            $fileName3 = 'EngTestReport' . '_' . time() . '.' . $request->file3->extension();
            $request->file3->move('assets/files/student', $fileName3);
        } else {
            $fileName3 = $donor->file3;
        }

        if ($request->hasFile('file4')) {
            $fileName4 = '10thCer' . '_' . time() . '.' . $request->file4->extension();
            $request->file4->move('assets/files/student', $fileName4);
        } else {
            $fileName4 = $donor->file4;
        }

        if ($request->hasFile('file5')) {
            $fileName5 = '12thCer' . '_' . time() . '.' . $request->file5->extension();
            $request->file5->move('assets/files/student', $fileName5);
        } else {
            $fileName5 = $donor->file5;
        }

        if ($request->hasFile('file6')) {
            $fileName6 = 'DegCer' . '_' . time() . '.' . $request->file6->extension();
            $request->file6->move('assets/files/student', $fileName6);
        } else {
            $fileName6 = $donor->file6;
        }

        if ($request->hasFile('file7')) {
            $fileName7 = 'MCer' . '_' . time() . '.' . $request->file7->extension();
            $request->file7->move('assets/files/student', $fileName7);
        } else {
            $fileName7 = $donor->file7;
        }

        if ($request->hasFile('file8')) {
            $fileName8 = '10thTrans' . '_' . time() . '.' . $request->file8->extension();
            $request->file8->move('assets/files/student', $fileName8);
        } else {
            $fileName8 = $donor->file8;
        }

        if ($request->hasFile('file9')) {
            $fileName9 = '12thTrans' . '_' . time() . '.' . $request->file9->extension();
            $request->file9->move('assets/files/student', $fileName9);
        } else {
            $fileName9 = $donor->file9;
        }

        if ($request->hasFile('file10')) {
            $fileName10 = 'DegTrans' . '_' . time() . '.' . $request->file10->extension();
            $request->file10->move('assets/files/student', $fileName10);
        } else {
            $fileName10 = $donor->file10;
        }

        if ($request->hasFile('file11')) {
            $fileName11 = 'MTrans' . '_' . time() . '.' . $request->file11->extension();
            $request->file11->move('assets/files/student', $fileName11);
        } else {
            $fileName11 = $donor->file11;
        }

        if ($request->hasFile('file12')) {
            $fileName12 = 'EoW' . '_' . time() . '.' . $request->file12->extension();
            $request->file12->move('assets/files/student', $fileName12);
        } else {
            $fileName12 = $donor->file12;
        }

        if ($request->hasFile('file13')) {
            $fileName13 = 'Other' . '_' . time() . '.' . $request->file13->extension();
            $request->file13->move('assets/files/student', $fileName13);
        } else {
            $fileName13 = $donor->file13;
        }
        $path = imagePath()['donor']['path'];
        $size = imagePath()['donor']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $donor->image = $filename;
        }
        $donor->firstname = $request->firstname;
        $donor->username = $request->firstname . rand(pow(10, 8 - 1), pow(10, 8) - 1);
        $donor->password = Hash::make('12345678');
        $donor->lastname = $request->lastname;
        $donor->phone = $request->phone;
        $donor->whatsapp = $request->whatsapp;
        $donor->engtest = json_encode($request->engtest);
        $donor->score_overall = $request->score_overall;
        $donor->low_score = $request->low_score;
        $donor->country = $request->country;
        $donor->qualification = $request->qualification;
        $donor->email = $request->email;
        $donor->course = $request->course;
        $donor->file = $fileName;
        $donor->file2 = $fileName2;
        $donor->file3 = $fileName3;
        $donor->file4 = $fileName4;
        $donor->file5 = $fileName5;
        $donor->file6 = $fileName6;
        $donor->file7 = $fileName7;
        $donor->file8 = $fileName8;
        $donor->file9 = $fileName9;
        $donor->file10 = $fileName10;
        $donor->file11 = $fileName11;
        $donor->file12 = $fileName12;
        $donor->file13 = $fileName13;
        $donor->status = '0';
        $donor->save();
        $notify[] = ['success', 'Student has been created'];
        return back()->withNotify($notify);
    }

    public function edit($id)
    {
        $pageTitle = "Students Update";
        $donor = Donor::findOrFail($id);
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        return view('user.donor.edit', compact('pageTitle', 'cities', 'bloods', 'donor'));
    }

    public function view($id)
    {
        $pageTitle = "Students Information";
        $donor = Donor::findOrFail($id);
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        return view('user.donor.view', compact('pageTitle', 'cities', 'bloods', 'donor'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'required|email|max:60|unique:donors,email,' . $id,
            'phone' => 'required|max:40|unique:donors,phone,' . $id,
            'city' => 'required|exists:cities,id',
            'location' => 'required|exists:locations,id',
            'blood' => 'required|exists:bloods,id',
            'gender' => 'required|in:1,2',
            'religion' => 'required|max:40',
            'profession' => 'required|max:80',
            'donate' => 'required|integer',
            'address' => 'required|max:255',
            // 'details' => 'required',
            'birth_date' => 'required|date',
            // 'last_donate' =>'required|date',
            // 'facebook' => 'required',
            // 'twitter' => 'required',
            // 'linkedinIn' => 'required',
            // 'instagram' => 'required',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $donor = Donor::findOrFail($id);
        $donor->name = $request->name;
        $donor->email = $request->email;
        $donor->phone = $request->phone;
        $donor->city_id = $request->city;
        $donor->blood_id = $request->blood;
        $donor->location_id = $request->location;
        $donor->gender = $request->gender;
        $donor->religion = $request->religion;
        $donor->profession = $request->profession;
        $donor->address = $request->address;
        $donor->details = $request->details;
        $donor->total_donate = $request->donate;
        $donor->birth_date =  $request->birth_date;
        $donor->last_donate = $request->last_donate;
        $socialMedia = [
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedinIn' => $request->linkedinIn,
            'instagram' => $request->instagram
        ];
        $donor->socialMedia = $socialMedia;
        $path = imagePath()['donor']['path'];
        $size = imagePath()['donor']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size, $donor->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $donor->image = $filename;
        }
        $donor->status = $request->status ? 1 : 2;
        $donor->save();
        $notify[] = ['success', 'Students has been updated'];
        return back()->withNotify($notify);
    }
}
