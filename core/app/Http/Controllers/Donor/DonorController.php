<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Advertisement;
use App\Models\Blood;
use App\Models\City;
use App\Models\Donor;
use App\Models\Location;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class DonorController extends Controller
{

    public function dashboard()
    {
        $pageTitle = 'Donor Dashboard';
        $blood = Blood::count();
        $city = City::count();
        $locations = Location::count();
        $ads = Advertisement::count();
        $don['all'] = Donor::count();
        $don['pending'] = Donor::where('status', 0)->count();
        $don['approved'] = Donor::where('status', 1)->count();
        $don['banned'] = Donor::where('status', 0)->count();
        $donors = Donor::orderBy('id', 'DESC')->with('blood', 'location')->limit(8)->get();
        $donor = Auth::guard('donor')->user();
        return view('student.dashboard', compact('pageTitle', 'don', 'blood', 'city', 'locations', 'ads', 'donors', 'donor'));
    }

    public function profile()
    {
        $pageTitle = 'Profile';
        $donor = Auth::guard('donor')->user();
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        return view('student.profile', compact('pageTitle', 'donor', 'cities', 'bloods'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|max:80',
            'lastname' => 'required|max:80',
            'whatsapp' => 'required|max:40',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'file' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file2' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file3' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file4' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file5' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file6' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file7' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file8' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file9' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file10' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file11' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file12' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
            'file13' => ['nullable', 'file', new FileTypeValidate(['jpg', 'jpeg', 'png', 'pdf'])],
        ]);
        $user = Auth::guard('donor')->user();

        if ($request->hasFile('image')) {

            try {
                $old = $user->image ?: null;
                $path = imagePath()['donor']['path'];
                $size = imagePath()['donor']['size'];
                $user->image = uploadImage($request->image, $path, $size, $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('file')) {
            $fileName = $user->id . '_' . 'passport' . '_' . time() . '.' . $request->file->extension();
            $request->file->move('assets/files/student', $fileName);
        } else {
            $fileName = null;
        }

        if ($request->hasFile('file2')) {
            $fileName2 = $user->id . '_' . 'CV' . '_' . time() . '.' . $request->file2->extension();
            $request->file2->move('assets/files/student', $fileName2);
        } else {
            $fileName2 = null;
        }

        if ($request->hasFile('file3')) {
            $fileName3 = $user->id . '_' . 'EngTestReport' . '_' . time() . '.' . $request->file3->extension();
            $request->file3->move('assets/files/student', $fileName3);
        } else {
            $fileName3 = null;
        }

        if ($request->hasFile('file4')) {
            $fileName4 = $user->id . '_' . '10thCer' . '_' . time() . '.' . $request->file4->extension();
            $request->file4->move('assets/files/student', $fileName4);
        } else {
            $fileName4 = null;
        }

        if ($request->hasFile('file5')) {
            $fileName5 = $user->id . '_' . '12thCer' . '_' . time() . '.' . $request->file5->extension();
            $request->file5->move('assets/files/student', $fileName5);
        } else {
            $fileName5 = null;
        }

        if ($request->hasFile('file6')) {
            $fileName6 = $user->id . '_' . 'DegCer' . '_' . time() . '.' . $request->file6->extension();
            $request->file6->move('assets/files/student', $fileName6);
        } else {
            $fileName6 = null;
        }

        if ($request->hasFile('file7')) {
            $fileName7 = $user->id . '_' . 'MCer' . '_' . time() . '.' . $request->file7->extension();
            $request->file7->move('assets/files/student', $fileName7);
        } else {
            $fileName7 = null;
        }

        if ($request->hasFile('file8')) {
            $fileName8 = $user->id . '_' . '10thTrans' . '_' . time() . '.' . $request->file8->extension();
            $request->file8->move('assets/files/student', $fileName8);
        } else {
            $fileName8 = null;
        }

        if ($request->hasFile('file9')) {
            $fileName9 = $user->id . '_' . '12thTrans' . '_' . time() . '.' . $request->file9->extension();
            $request->file9->move('assets/files/student', $fileName9);
        } else {
            $fileName9 = null;
        }

        if ($request->hasFile('file10')) {
            $fileName10 = $user->id . '_' . 'DegTrans' . '_' . time() . '.' . $request->file10->extension();
            $request->file10->move('assets/files/student', $fileName10);
        } else {
            $fileName10 = null;
        }

        if ($request->hasFile('file11')) {
            $fileName11 = $user->id . '_' . 'MTrans' . '_' . time() . '.' . $request->file11->extension();
            $request->file11->move('assets/files/student', $fileName11);
        } else {
            $fileName11 = null;
        }

        if ($request->hasFile('file12')) {
            $fileName12 = $user->id . '_' . 'EoW' . '_' . time() . '.' . $request->file12->extension();
            $request->file12->move('assets/files/student', $fileName12);
        } else {
            $fileName12 = null;
        }

        if ($request->hasFile('file13')) {
            $fileName13 = $user->id . '_' . 'Other' . '_' . time() . '.' . $request->file13->extension();
            $request->file13->move('assets/files/student', $fileName13);
        } else {
            $fileName13 = null;
        }

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->whatsapp = $request->whatsapp;
        $user->pte = $request->ielts;
        $user->pte = $request->pte;
        $user->pte = $request->duolingo;
        $user->pte = $request->oeitc;
        $user->pte = $request->none;
        $user->score_overall = $request->score_overall;
        $user->low_score = $request->low_score;
        $user->country = $request->country;
        $user->qualification = $request->qualification;
        $user->course = $request->course;
        $user->file = $fileName;
        $user->file2 = $fileName2;
        $user->file3 = $fileName3;
        $user->file4 = $fileName4;
        $user->file5 = $fileName5;
        $user->file6 = $fileName6;
        $user->file7 = $fileName7;
        $user->file8 = $fileName8;
        $user->file9 = $fileName9;
        $user->file10 = $fileName10;
        $user->file11 = $fileName11;
        $user->file12 = $fileName12;
        $user->file13 = $fileName13;

        $user->save();
        $notify[] = ['success', 'Your profile has been updated.'];
        return redirect()->route('student.profile')->withNotify($notify);
    }


    public function password()
    {
        $pageTitle = 'Password Setting';
        $donor = Auth::guard('donor')->user();
        return view('student.password', compact('pageTitle', 'donor'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = Auth::guard('donor')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password do not match !!'];
            return back()->withNotify($notify);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return redirect()->route('student.password')->withNotify($notify);
    }

    public function requestReport()
    {
        $pageTitle = 'Your Listed Report & Request';
        $arr['app_name'] = systemDetails()['name'];
        $arr['app_url'] = env('APP_URL');
        $arr['purchase_code'] = env('PURCHASE_CODE');
        $url = "https://license.viserlab.com/issue/get?" . http_build_query($arr);
        $response = json_decode(curlContent($url));
        if ($response->status == 'error') {
            return redirect()->route('student.dashboard')->withErrors($response->message);
        }
        $reports = $response->message[0];
        return view('student.reports', compact('reports', 'pageTitle'));
    }

    public function reportSubmit(Request $request)
    {
        $request->validate([
            'type' => 'required|in:bug,feature',
            'message' => 'required',
        ]);
        $url = 'https://license.viserlab.com/issue/add';

        $arr['app_name'] = systemDetails()['name'];
        $arr['app_url'] = env('APP_URL');
        $arr['purchase_code'] = env('PURCHASE_CODE');
        $arr['req_type'] = $request->type;
        $arr['message'] = $request->message;
        $response = json_decode(curlPostContent($url, $arr));
        if ($response->status == 'error') {
            return back()->withErrors($response->message);
        }
        $notify[] = ['success', $response->message];
        return back()->withNotify($notify);
    }

    public function systemInfo()
    {
        $laravelVersion = app()->version();
        $serverDetails = $_SERVER;
        $currentPHP = phpversion();
        $timeZone = config('app.timezone');
        $pageTitle = 'System Information';
        return view('student.info', compact('pageTitle', 'currentPHP', 'laravelVersion', 'serverDetails', 'timeZone'));
    }
}
