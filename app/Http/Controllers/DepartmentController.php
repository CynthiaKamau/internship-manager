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

    public function create()
    {
        $title = 'Create Department';
        return view('department.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->merge(['facility_id' => Auth::user()->id]);
        Category::create($request->all());
        flash('Deprtment created successfully!')->success();
        return redirect()->route('department.index');
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
