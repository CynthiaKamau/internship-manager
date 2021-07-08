<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Facility;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $departments = Department::with(['facilities'])->where('name', 'like', '%'.$request->search.'%')->paginate(setting('record_per_page', 15));
        } else {
            $departments = Department::with(['facilities'])->paginate(setting('record_per_page', 15));
        }

        $title = 'Manage Departments';

        return view('department.index', compact('departments', 'title'));

    }

    public function create()
    {
        $title = 'Create Department';
        return view('department.create', compact('title'));
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $department = new Department;
            $department->name = $request->dname;
            $department->status = $request->status;
            $department->created_at = Carbon::now();
            $department->save();

            flash('Deprtment created successfully!')->success();
            return redirect()->route('department.index');

        } catch (\Exception $e) {

            flash('Failed!')->danger();
            return redirect()->route('department.index');

        }

    }

    public function show(Department $department)
    {
        return back();
    }

    public function edit(Department $department)
    {
        $title = "Department Details";
        return view('department.edit', compact('title', 'department'));
    }

    public function update(Request $request, Department $department)
    {
        try {
            $department->update($request->all());
            flash('Department updated successfully!')->success();
            return back();

        }catch (\Exception $e) {
            flash('Failed!')->danger();
            return back();
        }
        
    }    

    public function destroy(Department $department)
    {
        $department->delete();
        flash('Department deleted successfully!')->info();
        return back();
    }


}
