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

class FacilityDepartmentController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->role_id == '1') {

            if ($request->has('search')) {
                $facility_departments = FacilityDepartment::with(['department', 'facility'])->where('department_name', 'like', '%'.$request->search.'%')->paginate(setting('record_per_page', 15));
            } else {
                $facility_departments = FacilityDepartment::with(['department', 'facility'])->paginate(setting('record_per_page', 15));
            }

        } else {

            if ($request->has('search')) {
                $facility_departments = FacilityDepartment::with(['department', 'facility'])->where('department_name', 'like', '%'.$request->search.'%')->paginate(setting('record_per_page', 15));
            } else {
                 $facility_departments = FacilityDepartment::with(['department', 'facility'])->where('facility_id', Auth::user()->profile->facility_id)->paginate(setting('record_per_page', 15));
            }

        }

        $title = 'Manage Facility Departments';

        return view('facility_department.index', compact('title', 'facility_departments'));

    }

    public function create()
    {
        $title = 'Create Facility Department';
        if(Auth::user()->role_id == '1') {
            $facilities = Facility::all();
        } else {
            $facilities = Facility::where('id', Auth::user()->profile->facility_id)->get();
        }

        $departments = Department::all();

        return view('facility_department.create', compact('title', 'facilities', 'departments'));
    }

    public function store(Request $request)
    {
        try {
            $department = new FacilityDepartment;
            $department->department_id = $request->department_id;
            $department->facility_id = $request->facility_id;

            if(empty($request->status)) {
                $department->status = 0;
            } else {
                $department->status = $request->status;
            }
            $department->created_at = Carbon::now();

            $department->save();

            flash('Depertment created successfully!')->success();
            return redirect()->route('facility_department.index');


        } catch (\Exception $e) {

            flash('Failed!')->success();
            return redirect()->route('facility_department.index');

        }

    }

    public function show(FacilityDepartment $facility_department)
    {
        return back();
    }

    public function edit(FacilityDepartment $facility_department)
    {
        $title = "Department Details";
        $departments = Department::all();
        if(Auth::user()->role_id == '1') {
            $facilities = Facility::all();
        } else {
            $facilities = Facility::where('id', Auth::user()->profile->facility_id)->get();
        }
        return view('facility_department.edit', compact('title', 'facility_department', 'departments', 'facilities'));
    }

    public function update(Request $request, FacilityDepartment $facility_department)
    {
        
        $facility_department->update($request->all());
        flash('Department updated successfully!')->success();
        return back();
    }

    public function destroy(FacilityDepartment $facility_department)
    {
        $facility_department->delete();
        flash('Department deleted successfully!')->info();
        return back();
    }


}
