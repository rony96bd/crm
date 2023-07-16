<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Blood;
use App\Models\City;
use App\Models\Donor;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class ManageDonorController extends Controller
{

    public function index()
    {
        $username = auth()->guard('agent')->user()->username;
        $pageTitle = "Manage Students List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::latest()
                ->where('agent', $username)
                ->paginate(getPaginate());
        return view('agent.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods'));
    }

    public function pending()
    {
        $pageTitle = "Pending Students List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::where('status', 0)->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('agent.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods'));
    }

    public function approved()
    {
        $pageTitle = "Approved Students List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::where('status', 1)->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('agent.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods'));
    }

    public function banned()
    {
        $pageTitle = "Banned Students List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::where('status', 2)->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('agent.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods'));
    }

    public function create()
    {
        $pageTitle = "Student Create";
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        return view('agent.donor.create', compact('pageTitle', 'cities', 'bloods'));
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
        return view('agent.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods', 'bloodId'));
    }

    public function search(Request $request)
    {
        $pageTitle = "Students Search";
        $emptyMessage = "No data found";
        $search = $request->search;
        $bloods = Blood::where('status', 1)->select('id', 'firstname', 'lastname')->get();
        $donors = Donor::where('firstname', 'like', "%$search%")->latest()->with('firstname', 'lastname')->paginate(getPaginate());
        return view('agent.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'search'));
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
            'name' => 'required|max:80',
            'email' => 'required|email|max:60|unique:donors,email',
            'phone' => 'required|max:40|unique:donors,phone',
            'city' => 'required|exists:cities,id',
            'location' => 'required|exists:locations,id',
            'blood' => 'required|exists:bloods,id',
            'gender' => 'required|in:1,2',
            'religion' => 'required|max:40',
            'profession' => 'required|max:80',
            'donate' => 'required|integer',
            'address' => 'required|max:255',
            'details' => 'required',
            'birth_date' => 'required|date',
            'last_donate' => 'required|date',
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedinIn' => 'required',
            'instagram' => 'required',
            'image' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $donor = new Donor();
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
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $donor->image = $filename;
        }
        $donor->status = $request->status ? 1 : 2;
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
        return view('agent.donor.edit', compact('pageTitle', 'cities', 'bloods', 'donor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'required|email|max:60|unique:donors,email,'.$id,
            'phone' => 'required|max:40|unique:donors,phone,'.$id,
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
