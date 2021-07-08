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
        if ($request->has('search')) {
           $departments = FacilityDepartment::with(['department', 'facility'])->where('department_name', 'like', '%'.$request->search.'%')->paginate(setting('record_per_page', 15));
        } else {
            $departments = FacilityDepartment::with(['facility'])->where('facility_id', Auth::user()->profile->facility_id)->paginate(setting('record_per_page', 15));
        }

        $title = 'Manage Facility Departments';

        return view('facility_department.index', compact('title', 'departments'));

    }

    public function create()
    {
        $title = 'Create Facility Department';
        $facilities = Facility::where('id', Auth::user()->profile->facility_id)->get();
        
        return view('facility_department.create', compact('title', 'facilities'));
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $department = new Department;
            $department->name = $request->dname;

            if(empty($request->status)) {
                $department->status = 0;
            } else {
                $department->status = $request->status;
            }
            $department->created_at = Carbon::now();

            if($department->save() ) {

                $facility_id = Facility::where('id', Auth::user()->profile->facility_id)->get();

                $department->facilities()->sync($facility_id);

                flash('Depertment created successfully!')->success();
                return redirect()->route('facility_department.index');

            }

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
        $facility_department->with('facility');
        $facilities = Facility::where('id', Auth::user()->profile->facility_id)->get();
        return view('facility_department.edit', compact('title', 'facility_department', 'facilities'));
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

    public function get_departments(Request $request)
    {
        
        $departments = FacilityDepartment::with(['facility', 'department'])->where('facility_id', $request->facility_id)->get();

        return $departments;

    }


}
