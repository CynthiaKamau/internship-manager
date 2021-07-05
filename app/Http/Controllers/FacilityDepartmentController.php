<?php

namespace App\Http\Controllers;

use App\Models\FacilityDepartment;
use App\Models\Facility;
use App\Models\Profile;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class FacilityDepartmentController extends Controller
{
    public function index(Request $request, Profile $profile)
    {
        if ($request->has('search')) {
           //$departments = FacilityDepartment::with(['department', 'facility'])->where('department_name', 'like', '%'.$request->search.'%')->paginate(setting('record_per_page', 15));
        } else {
            $departments = FacilityDepartment::with(['department', 'facility'])->where('facility_id', $profile->facility_id)->paginate(setting('record_per_page', 15));
        }

        $title = 'Manage Facility Departments';

        return view('facility_department.index', compact('title', 'departments'));

    }

    public function create(Profile $profile)
    {
        $title = 'Create Department';
        $facilities = Facility::where('id', $profile->facility_id)->get();
        
        return view('department.create', compact('title', 'facilities'));
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $department = new Department;
            $department->name = $request->department_name;
            $department->status = $request->status;
            $department->created_at = Carbon::now();

            if($department->save() ) {

                $facility_id = $request->facility_id;

                $department->facilities()->sync($facility_id);

                flash('Deprtment created successfully!')->success();
                return redirect()->route('department.index');

            }

        } catch (\Exception $e) {

            //flash('Failed!')->success();
            return $e;

        }

    }

    public function show(Department $department)
    {
        return back();
    }

    public function edit(Department $department)
    {
        $title = "Department Details";
        $department->with('facility');
        return view('department.edit', compact('title', 'department'));
    }

    public function update(Request $request, Department $department)
    {
        $department->update($request->all());
        flash('Department updated successfully!')->success();
        return back();
    }

    public function destroy(Department $department)
    {
        $department->delete();
        flash('Department deleted successfully!')->info();
        return back();
    }


}
