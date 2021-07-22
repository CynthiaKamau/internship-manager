<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSummary;
use App\Models\County;
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
    public function index(Request $request)
    {

        $counties = County::all();

        return view('home', compact('counties'));
    }

    public function data(Request $request)
    {
        $data = [];

        $counties = County::all();

        if(Auth::user()->role_id == 1) {


            $students = UserSummary::select(DB::raw("COUNT(*) as count"))
                            ->where('role', 'Student')->groupBy('role')
                            ->count();

            $practitioners = UserSummary::select(DB::raw("COUNT(*) as count"))
                                ->where('role', 'Practitioner')->groupBy('role')
                                ->count();

            $everyone = UserSummary::select(DB::raw("COUNT(*) as count"))
                            ->count();

            $new_users = UserSummary::select(DB::raw("COUNT(*) as count"))
                            ->whereDate('created_at', Carbon::today())
                            ->count();

            $users = UserSummary::select(
                DB::raw("COUNT(*) as y"),
                DB::raw('role as name')
            )
                ->groupBy('roles.name')
                ->get();

            $g_users = UserSummary::select(
                DB::raw("COUNT(*) as y"),
                DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear")
                )
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('monthyear')
                    ->get();

        } else {

            $students = UserSummary::select(DB::raw("COUNT(*) as count"))
                            ->where('role', 'Student')
                            ->where('facility_id', Auth::user()->profile->facility_id )
                            ->groupBy('role')
                            ->count();

            $practitioners = UserSummary::select(DB::raw("COUNT(*) as count"))
                                ->where('role', 'Practitioner')
                                ->where('facility_id', Auth::user()->profile->facility_id )
                                ->groupBy('role')
                                ->count();

            $everyone = UserSummary::select(DB::raw("COUNT(*) as count"))
                            ->where('facility_id', Auth::user()->profile->facility_id )
                            ->count();

            $new_users = UserSummary::select(DB::raw("COUNT(*) as count"))
                            ->whereDate('created_at', Carbon::today())
                            ->where('facility_id', Auth::user()->profile->facility_id )
                            ->count();

            $users = UserSummary::select(
                DB::raw("COUNT(*) as y"),
                DB::raw('role as name')
            )
                ->where('facility_id', Auth::user()->profile->facility_id )
                ->groupBy('roles.name')
                ->get();

            $g_users = UserSummary::select(
                DB::raw("COUNT(*) as y"),
                DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear")
                )
                    ->where('facility_id', Auth::user()->profile->facility_id )
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('monthyear')
                    ->get();

        }

        $data["users"] = $users;
        $data["students"] = $students;
        $data["practitioners"] = $practitioners;
        $data["g_users"] = $g_users;
        $data["new_users"] = $new_users;
        $data["everyone"] = $everyone;
        $data["counties"] = $counties;

        return $data;

    }

    public function filtered_data(Request $request)
    {
        $data = [];

        $counties = County::all();

        $county = $request->county;
        $sub_county = $request->sub_county;
        $facility = $request->facility;
        $selected_dates = $request->daterange;

        $dates = explode('-', $selected_dates);

        $unformatted_startdate = trim($dates[0]);
        $unformatted_enddate = trim($dates[1]);

        $start_date = Carbon::createFromFormat('m/d/Y', $unformatted_startdate)->format('Y-m-d');
        $end_date = Carbon::createFromFormat('m/d/Y', $unformatted_enddate)->format('Y-m-d');


        $students = UserSummary::select(DB::raw("COUNT(*) as count"))
                    ->where('role', 'Student')
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->groupBy('role');

        $practitioners = UserSummary::select(DB::raw("COUNT(*) as count"))
                            ->where('role', 'Practitioner')
                            ->whereBetween('created_at', [$start_date, $end_date])
                            ->groupBy('role');

        $everyone = UserSummary::select(DB::raw("COUNT(*) as count"))
                        ->whereBetween('created_at', [$start_date, $end_date]);

        $new_users = UserSummary::select(DB::raw("COUNT(*) as count"))
                        ->whereDate('created_at', Carbon::today());

        $users = UserSummary::select(
                        DB::raw("COUNT(*) as y"),
                        DB::raw('role as name')
                    )
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->groupBy('roles.name');

        $g_users = UserSummary::select(
                        DB::raw("COUNT(*) as y"),
                    DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear")
                    )
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('monthyear');

        if(!empty($county)) {

            $students = $students->whereIn('county_id', $county);

            $practitioners = $practitioners->whereIn('county_id', $county);

            $everyone = $everyone->whereIn('county_id', $county);

            $new_users = $new_users->whereIn('county_id', $county);

            $users = $users->whereIn('county_id', $county);
                            
            $g_users = $g_users->whereIn('county_id', $county);

        }

        if(!empty($sub_county)) {

            $students = $students->whereIn('sub_county_id', $sub_county);

            $practitioners = $practitioners->whereIn('sub_county_id', $sub_county);

            $everyone = $everyone->whereIn('sub_county_id', $sub_county);

            $new_users = $new_users->whereIn('sub_county_id', $sub_county);

            $users = $users->whereIn('sub_county_id', $sub_county);
                            
            $g_users = $g_users->whereIn('sub_county_id', $sub_county);

        }

        if(!empty($facility)) {

            $students = $students->whereIn('facility_id', $facility);

            $practitioners = $practitioners->whereIn('facility_id', $facility);

            $everyone = $everyone->whereIn('facility_id', $facility);

            $new_users = $new_users->whereIn('facility_id', $facility);

            $users = $users->whereIn('facility_id', $facility);
                            
            $g_users = $g_users->whereIn('facility_id', $facility);

        }

        $data["users"] = $users->get();
        $data["students"] = $students->count();
        $data["practitioners"] = $practitioners->count();
        $data["g_users"] = $g_users->get();
        $data["new_users"] = $new_users->count();
        $data["everyone"] = $everyone->count();
        $data["counties"] = $counties;

        return $data;

    }
    
}
