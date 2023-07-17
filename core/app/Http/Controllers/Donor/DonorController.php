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
            'name' => 'required',
            'phone' => 'required',
            'blood' => 'required|exists:bloods,id',
            'city' => 'required|exists:cities,id',
            'location' => 'required|exists:locations,id',
            'gender' => 'required|in:1,2',
            // 'facebook' => 'required',
            // 'twitter' => 'required',
            // 'linkedinIn' => 'required',
            // 'instagram' => 'required',
            'profession' => 'required|max:80',
            'religion' => 'required|max:40',
            'address' => 'required|max:255',
            // 'donate' => 'required|integer',
            'birth_date' => 'required|date',
            // 'last_donate' => 'required|date',
            'details' => 'required',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])]
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

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->blood_id = $request->blood;
        $user->city_id = $request->city;
        $user->location_id = $request->location;
        $user->gender = $request->gender;
        $socialMedia = [
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedinIn' => $request->linkedinIn,
            'instagram' => $request->instagram
        ];
        $user->socialMedia = $socialMedia;
        $user->profession = $request->profession;
        $user->religion = $request->religion;
        $user->address = $request->address;
        $user->total_donate = $request->donate;
        $user->birth_date =  $request->birth_date;
        $user->last_donate = $request->last_donate;
        $user->details = $request->details;
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
