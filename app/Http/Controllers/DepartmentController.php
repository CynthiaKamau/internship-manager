<?php

namespace App\Http\Controllers;

use App\Models\FacilityDepartment;
use App\Models\Department;
use App\Models\Facility;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $departments = Department::with(['facilities'])->where('department_name', 'like', '%'.$request->search.'%')->paginate(setting('record_per_page', 15));
        } else {
            $departments = Department::with(['facilities'])->paginate(setting('record_per_page', 15));
        }

        $title = 'Manage Departments';

        return view('department.index', compact('departments', 'title'));

    }

    public function create()
    {
        $title = 'Create Department';
        $facilities = Facility::all();
        return view('department.create', compact('title', 'facilities'));
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $department = new Department;
            $department->name = $request->department_name;
            $department->status = $request->status;

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

    public function show(FacilityDepartment $facilitydepartment)
    {
        return back();
    }

    public function edit(FacilityDepartment $facilitydepartment)
    {
        $title = "Department Details";
        $facilitydepartment->with('facility');
        return view('department.edit', compact('title', 'facilitydepartment'));
    }

    public function update(Request $request, FacilityDepartment $facilitydepartment)
    {
        $facilitydepartment->update($request->all());
        flash('Department updated successfully!')->success();
        return back();
    }

    public function destroy(FacilityDepartment $facilitydepartment)
    {
        $category->delete();
        flash('Department deleted successfully!')->info();
        return back();
    }


}
