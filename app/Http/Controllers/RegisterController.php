<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Facility;
use App\Models\Country;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Mail\UserRegistered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    public function create()
    {
        $title = 'Create user';
        $facilities = Facility::all();
        $countries = Country::all();

       return view('auth.register', compact('facilities', 'title', 'countries'));
    }

    protected function store(UserStoreRequest $request)
    {

        $user = User::create([
            'first_name' => request('first_name'),
            'middle_name' => request('middle_name'),
            'last_name' => request('last_name'),
            'nckid' => request('nckid'),
            'msisdn' => request('msisdn'),
            'email' => request('email'),
            'role_id' => request('role_id'),
            'status' => 1,
            'password' => request('password')
        ]);

        if (setting('register_notification_email')) {
            Mail::to($data['email'])->send( new UserRegistered($user));
        }
        if ( setting('default_role')) {
            $user->assignRole(setting('default_role'));
        }
        
        flash('User created successfully!')->success();
        return redirect()->route('users.index');
    }
}
