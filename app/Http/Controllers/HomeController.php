<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::user()->role_id == 1) {

            $students = User::select(DB::raw("COUNT(*) as count"))
                            ->where('role_id', 3)->groupBy('role_id')
                            ->pluck('count')->first();

            $practitioners = User::select(DB::raw("COUNT(*) as count"))
                                ->where('role_id', 2)->groupBy('role_id')
                                ->pluck('count')->first();

            $everyone = User::select(DB::raw("COUNT(*) as count"))->pluck('count')->first();

            $new_users = User::select(DB::raw("COUNT(*) as count"))
                                ->whereDate('created_at', Carbon::today())
                                ->pluck('count')->first();

            $users = User::select(
                DB::raw("COUNT(*) as y"),
                DB::raw('roles.name as name')
            )
                ->join('roles', 'roles.id', 'users.role_id')
                ->groupBy('roles.name')
                ->get();
                // ->whereBetween('users.created_at', [$start_date, $end_date]);
                // ->pluck('role_count');

            $g_users = User::select(DB::raw("COUNT(*) as count"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck('count');

        } else {

            $students = User::select(DB::raw("COUNT(*) as count"))
                            ->join('profiles', 'profiles.user_id', 'users.id' )
                            ->where('role_id', 3)->groupBy('role_id')
                            ->where('profiles.facility_id', Auth::user()->profile->facility_id)
                            ->pluck('count')->first();

            $practitioners = User::select(DB::raw("COUNT(*) as count"))
                                ->join('profiles', 'profiles.user_id', 'users.id' )
                                ->where('role_id', 2)->groupBy('role_id')
                                ->where('profiles.facility_id', Auth::user()->profile->facility_id)
                                ->pluck('count')->first();

            $everyone = User::select(DB::raw("COUNT(*) as count"))
                                ->join('profiles', 'profiles.user_id', 'users.id' )
                                ->where('profiles.facility_id', Auth::user()->profile->facility_id)
                                ->pluck('count')->first();

            $new_users = User::select(DB::raw("COUNT(*) as count"))
                                ->join('profiles', 'profiles.user_id', 'users.id' )
                                ->whereDate('users.created_at', Carbon::today())
                                ->where('profiles.facility_id', Auth::user()->profile->facility_id)
                                ->pluck('count')->first();

            $users = User::select(
                DB::raw("COUNT(*) as y"),
                DB::raw('roles.name as name')
            )
                ->join('roles', 'roles.id', 'users.role_id')
                ->join('profiles', 'profiles.user_id', 'users.id' )
                ->where('profiles.facility_id', Auth::user()->profile->facility_id)
                ->groupBy('roles.name')
                ->get();

            $g_users = User::select(DB::raw("COUNT(*) as count"),
            )
            ->join('roles', 'roles.id', 'users.role_id')
            ->whereYear('created_at', date('Y'))
            ->where('profiles.facility_id', Auth::user()->profile->facility_id)
            ->groupBy('created_at')
            ->pluck('count');
               


        }

        return view('home', compact('users', 'g_users', 'students', 'practitioners', 'everyone', 'new_users'));
    }
}
