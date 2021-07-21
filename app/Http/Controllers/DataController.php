<?php

namespace App\Http\Controllers;

use App\Models\FacilityDepartment;
use App\Models\County;
use App\Models\Facility;
use App\Models\Subcounty;
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

    
}
