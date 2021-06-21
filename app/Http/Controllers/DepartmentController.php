<?php

namespace App\Http\Controllers;

use App\Models\FacilityDepartment;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $departments = FacilityDepartment::with(['department'])->where('department_name', 'like', '%'.$request->search.'%')->paginate(setting('record_per_page', 15));
        } else {
            $departments = FacilityDepartment::with(['department'])->paginate(setting('record_per_page', 15));
        }

        $title = 'Manage Departments';

        return view('department.index', compact('departments', 'title'));

    }
}
