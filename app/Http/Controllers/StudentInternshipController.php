<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentInternship;
use Illuminate\Support\Facades\Auth;


class StudentInternshipController extends Controller
{
    public function index(Request $request)
    {
        // return $students = StudentInternship::with(['student', 'supervisor', 'internship' => function($q) {
        //     $q->where('facility_id', '=', Auth::user()->profile->facility_id);
        // }])->paginate(setting('record_per_page', 25));

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

    public function show(StudentInternship $student_internship)
    {
        return back();
    }

    public function edit(StudentInternship $student_internship)
    {

        
    }

    public function update(StudentInternship $student_internship)
    {

    }

    public function destroy(StudentInternship $student_internship)
    {

    }


}
