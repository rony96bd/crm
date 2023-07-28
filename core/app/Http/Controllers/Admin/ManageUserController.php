<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blood;
use App\Models\City;
use App\Models\Agent;
use App\Models\User;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ManageUserController extends Controller
{

    public function index()
    {
        $pageTitle = "Manage User List";
        $emptyMessage = "No data found";
        $users = User::latest()->paginate(getPaginate());
        return view('admin.user.index', compact('pageTitle', 'emptyMessage', 'users'));
    }

    public function pending()
    {
        $pageTitle = "Pending Agent List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $agents = Agent::where('status', 0)->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('admin.agent.index', compact('pageTitle', 'emptyMessage', 'agents', 'bloods'));
    }

    public function approved()
    {
        $pageTitle = "Approved Agent List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $agents = Agent::where('status', 1)->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('admin.agent.index', compact('pageTitle', 'emptyMessage', 'agents', 'bloods'));
    }

    public function banned()
    {
        $pageTitle = "Banned Agent List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $agents = Agent::where('status', 2)->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('admin.agent.index', compact('pageTitle', 'emptyMessage', 'agents', 'bloods'));
    }

    public function create()
    {
        $pageTitle = "User Create";
        $agents = Agent::all();
        return view('admin.user.create', compact('pageTitle', 'agents'));
    }

    public function agentBloodSearch(Request $request)
    {
        $request->validate([
            'blood_id' => 'required|exists:bloods,id'
        ]);
        $bloodId = $request->blood_id;
        $blood = Blood::findOrFail($request->blood_id);
        $pageTitle = $blood->name . " Blood Group Students List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $agents = Agent::where('blood_id', $request->blood_id)->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('admin.agent.index', compact('pageTitle', 'emptyMessage', 'agents', 'bloods', 'bloodId'));
    }

    public function search(Request $request)
    {
        $pageTitle = "Students Search";
        $emptyMessage = "No data found";
        $search = $request->search;
        $agents = Agent::where('firstname', 'like', "%$search%")->latest()->with('firstname', 'lastname')->paginate(getPaginate());
        return view('admin.agent.index', compact('pageTitle', 'emptyMessage', 'agents', 'search'));
    }

    public function approvedStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:agents,id'
        ]);
        $agent = Agent::findOrFail($request->id);
        $agent->status = 1;
        $agent->save();
        $notify[] = ['success', 'Agent has been approved'];
        return back()->withNotify($notify);
    }

    public function bannedStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:agents,id'
        ]);
        $agent = Agent::findOrFail($request->id);
        $agent->status = 2;
        $agent->save();
        $notify[] = ['success', 'Students has been canceled'];
        return back()->withNotify($notify);
    }


    public function featuredInclude(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:agents,id'
        ]);
        $agent = Agent::findOrFail($request->id);
        $agent->featured = 1;
        $agent->save();
        $notify[] = ['success', 'Include this Students featured list'];
        return back()->withNotify($notify);
    }

    public function featuredNotInclude(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:agents,id'
        ]);
        $agent = Agent::findOrFail($request->id);
        $agent->featured = 0;
        $agent->save();
        $notify[] = ['success', 'Remove this Students featured list'];
        return back()->withNotify($notify);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'required|email|max:60|unique:agents,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|max:40|unique:agents,phone',
            // 'image' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = rand(pow(10, 8 - 1), pow(10, 8) - 1);
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->manage_agent_id = json_encode($request->agents);

        // $path = imagePath()['agent']['path'];
        // $size = imagePath()['agent']['size'];
        // if ($request->hasFile('image')) {
        //     try {
        //         $filename = uploadImage($request->image, $path, $size);
        //     } catch (\Exception $exp) {
        //         $notify[] = ['error', 'Image could not be uploaded.'];
        //         return back()->withNotify($notify);
        //     }
        //     $agent->image = $filename;
        // }
        $user->status = '1';
        $user->save();
        $notify[] = ['success', 'User has been created'];
        return back()->withNotify($notify);
    }

    public function edit($id)
    {
        $pageTitle = "Students Update";
        $agent = Agent::findOrFail($id);
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        return view('admin.agent.edit', compact('pageTitle', 'cities', 'bloods', 'agent'));
    }

    public function view($id)
    {
        $pageTitle = "Agent Information";
        $user = User::findOrFail($id);
        return view('admin.user.view', compact('pageTitle', 'user'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'required|email|max:60|unique:agents,email,' . $id,
            'phone' => 'required|max:40|unique:agents,phone,' . $id,
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
        $agent = Agent::findOrFail($id);
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->phone = $request->phone;
        $agent->city_id = $request->city;
        $agent->blood_id = $request->blood;
        $agent->location_id = $request->location;
        $agent->gender = $request->gender;
        $agent->religion = $request->religion;
        $agent->profession = $request->profession;
        $agent->address = $request->address;
        $agent->details = $request->details;
        $agent->total_donate = $request->donate;
        $agent->birth_date =  $request->birth_date;
        $agent->last_donate = $request->last_donate;
        $socialMedia = [
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedinIn' => $request->linkedinIn,
            'instagram' => $request->instagram
        ];
        $agent->socialMedia = $socialMedia;
        $path = imagePath()['agent']['path'];
        $size = imagePath()['agent']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size, $agent->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $agent->image = $filename;
        }
        $agent->status = $request->status ? 1 : 2;
        $agent->save();
        $notify[] = ['success', 'Students has been updated'];
        return back()->withNotify($notify);
    }
}
