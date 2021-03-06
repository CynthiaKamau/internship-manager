<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Models\Facility;
use App\Models\FacilityDepartment;
use App\Models\Country;
use App\Models\Profile;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:view-user')->except(['profile', 'profileUpdate']);
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
        $this->middleware('permission:update-user', ['only' => ['edit','update']]);
        $this->middleware('permission:destroy-user', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role_id == 1) {

            if ($request->has('search')) {
                $users = User::where('name', 'like', '%'.$request->search.'%')->paginate(setting('record_per_page', 25));
            } else {
                $users= User::paginate(setting('record_per_page', 25));
            }

        } else {

            if ($request->has('search')) {
                $users= User::whereHas('profile', function ($query) {
                    $query->where('facility_id', Auth::user()->profile->facility_id);
                })
                ->where('name', 'like', '%'.$request->search.'%')
                ->paginate(setting('record_per_page', 25));

            } else {
                $users= User::whereHas('profile', function ($query) {
                    $query->where('facility_id', Auth::user()->profile->facility_id);
                })
                ->paginate(setting('record_per_page', 25));
            }

        }


        $title =  'Manage Users';

        return view('users.index', compact('users','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create user';
        $roles = Role::pluck('name', 'id');
        return view('users.create', compact('roles', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $userData = $request->except(['profile_photo']);
        if ($request->profile_photo) {
            $userData['profile_photo'] = parse_url($request->profile_photo, PHP_URL_PATH);
        }

        $user = User::create($userData);
        $user->assignRole($request->role_id);
        flash('User created successfully!')->success();
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $title = "User Details";
        $roles = Role::pluck('name', 'id');
        return view('users.show', compact('user','title', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $title = "User Details";
        $roles = Role::pluck('name', 'id');

        return view('users.edit', compact('user','title', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $userData = $request->except(['profile_photo']);
        if ($request->profile_photo) {
            $userData['profile_photo'] = parse_url($request->profile_photo, PHP_URL_PATH);
        }
        $user->update($userData);
        $user->syncRoles($request->role);
        flash('User updated successfully!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id == Auth::user()->id || $user->id ==1) {
            flash('You can not delete logged in user!')->warning();
            return back();
        }
        $user->delete();
        flash('User deleted successfully!')->info();
        return back();
    }

    public function profile(User $user)
    {
        $title = 'Edit Profile';
        $facilities = Facility::all();
        $countries = Country::all();

        $user = $user->load('profile');

        return view('users.profile', compact('title', 'user', 'countries', 'facilities'));
    }

    public function profileUpdate(Request $request, User $user)
    {

        $time = Carbon::now();

        if (empty($user->profile->id)) {
            $profile = new Profile;

            $profile->create([
                'user_id' =>$id,
                'citizenship' => request('citizenship'),
                'dob' => Carbon::parse(request('dob'))->toDate(),
                'address' => request('address'),
                'department_id' => request('department_id'),
                'facility_id' => request('facility_id'),
                'index_no' => request('index_no'),
                'reg_no' => request('reg_no'),
                'gender' => request('gender'),
                'profile_photo' => parse_url($request->profile_photo, PHP_URL_PATH),
                'created_at' => $time
            ]);

            flash('Profile updated successfully!')->success();
            return back();
        } else {
            $p = Profile::where('user_id', $user->id)->pluck('id')->first();

            $profile = Profile::find($p);

            $profile->update([
                'citizenship' => request('citizenship'),
                'dob' => Carbon::parse(request('dob'))->toDate(),
                'address' => request('address'),
                'department_id' => request('department_id'),
                'facility_id' => request('facility_id'),
                'index_no' => request('index_no'),
                'reg_no' => request('reg_no'),
                'gender' => request('gender'),
                'profile_photo' => parse_url($request->profile_photo, PHP_URL_PATH),
                'created_at' => $time
            ]);

            flash('Profile updated successfully!')->success();
            return back();
        }
    }
}
