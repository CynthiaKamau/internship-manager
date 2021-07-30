<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentInternship;
use App\Models\Facility;
use App\Models\UserSummary;
use Illuminate\Support\Facades\Auth;


class StudentInternshipController extends Controller
{
    public function index(Request $request)
    {

        if(Auth::user()->role_id == 1) {
            if($request->has('search')) {
                $students = StudentInternship::with(['supervisor', 'internship'])->where('name', 'like', '%'.$request->search.'%')->paginate(setting('record_per_page', 25));
            } else {
                $students = StudentInternship::with(['supervisor', 'internship'])->paginate(setting('record_per_page', 25));
            }

        } else {
            if($request->has('search')) {

                $students = StudentInternship::with(['student', 'supervisor', 'internship' => function($q) {
                    $q->where('facility_id', '=', Auth::user()->profile->facility_id);
                    $q->where('first_name', 'like', '%'.$request->search.'%');
                }])->paginate(setting('record_per_page', 25));

            } else {

                $students = StudentInternship::with(['student', 'supervisor', 'internship' => function($q) {
                    $q->where('facility_id', '=', Auth::user()->profile->facility_id);
                }])->paginate(setting('record_per_page', 25));

            }

        }

        return view('student_internship.index', compact('students'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show(StudentInternship $student)
    {
        return back();
    }

    public function edit(StudentInternship $student)
    {
        $title = "Add Supervisor";

        if (Auth::user()->role_id == '1') {
            $users = UserSummary::where('role', 'Practitioner')->get();
        } else {
            $users = UserSummary::where('role', 'Practitioner')->where('facility_id', Auth::user()->facility_id )->get();
        }

        return view('student_internship.edit', compact('title', 'student', 'users'));
        
    }

    public function update(StudentInternship $student, Request $request)
    {
        $student->update($request->all());
        flash('Student updated successfully!')->success();
        return back();

    }

    public function destroy(StudentInternship $student_internship)
    {

    }


}
