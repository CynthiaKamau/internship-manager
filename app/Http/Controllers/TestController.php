<?php

namespace App\Http\Controllers;

use App\Models\FacilityDepartment;
use App\Models\Department;
use App\Models\Facility;
use App\Models\Profile;
use App\Models\User;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
  

public function get_departments(Request $request)
    {
        
        $departments = FacilityDepartment::with(['facility', 'department'])->where('facility_id', $request->facility_id)->get();

        return $departments;

    }


}