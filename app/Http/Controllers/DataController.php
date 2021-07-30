<?php

namespace App\Http\Controllers;

use App\Models\FacilityDepartment;
use App\Models\County;
use App\Models\Facility;
use App\Models\Subcounty;
use App\Models\UserSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function get_departments(Request $request)
    {
        $departments = FacilityDepartment::with(['facility', 'department'])->where('facility_id', $request->facility_id)->get();

        return $departments;
    }

    public function get_sub_counties(Request $request)
    {

        $sub_counties = Subcounty::where('county_id', $request->county_id)->get();

        return $sub_counties;
    }

    public function get_facilities(Request $request)
    {

        $facilities = Facility::where('sub_county', $request->sub_county)->get();

        return $facilities;
    }

    public function get_dashboard_sub_counties(Request $request)
    {
        $county_ids = array();
        $strings_array = $request->county;
        if (!empty($strings_array)) {
            foreach ($strings_array as $each_id) {
                $county_ids[] = (int) $each_id;
            }
        }
        $sub_counties_with_data = UserSummary::select('sub_county_id')->groupBy('sub_county_id')->get();
        if (!empty($county_ids)) {
            $all_sub_counties = Subcounty::select('id', 'name')->distinct('id')->wherein('county_id', $county_ids)->wherein('id', $sub_counties_with_data)->groupBy('id', 'name')->get();
        } else {
            $all_sub_counties = Subcounty::select('id', 'name')->distinct('id')->wherein('id', $sub_counties_with_data)->groupBy('id', 'name')->get();
        }
        return $all_sub_counties;
    }

    public function get_dashboard_facilities(Request $request)
    {
        $sub_county_ids = array();
        $strings_array = $request->sub_county;
        if (!empty($strings_array)) {
            foreach ($strings_array as $each_id) {
                $sub_county_ids[] = (int) $each_id;
            }
        }

        $withUsers= UserSummary::select('mfl_code')->groupBy('mfl_code')->get();
     
        $all_facilities = Facility::select('facilities.code', 'facilities.name')
                        ->join('sub_county', 'sub_county.id', 'facilities.sub_county')
                        ->join('counties', 'counties.id', 'sub_county.county_id')
                        ->distinct('code')
                        ->wherein('facilities.sub_county', $sub_county_ids)
                        ->wherein('facilities.code', $withUsers)
                        ->groupBy('facilities.code', 'facilities.name')
                        ->get();
        
        return $all_facilities;
    }

    
}
