<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship;
use App\Models\Facility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->role_id == 1) {

            if ($request->has('search')) {
                $internships = Internship::where('name', 'like', '%'.$request->search.'%')->paginate(setting('record_per_page', 25));
            } else {
                $internships= Internship::paginate(setting('record_per_page', 25));
            }
        } else {

            if ($request->has('search')) {
                $internships= Internship::whereHas('facility', function ($query) {
                    $query->where('facility_id', Auth::user()->profile->facility_id);
                })
                ->where('name', 'like', '%'.$request->search.'%')
                ->paginate(setting('record_per_page', 25));

            } else {
                $internships= Internship::whereHas('facility', function ($query) {
                    $query->where('facility_id', Auth::user()->profile->facility_id);
                })
                ->paginate(setting('record_per_page', 25));
            }

        }

        $title = "Student Internships";

        return view('internships.index', compact('title', 'internships'));
    }

    public function create()
    {
        $title = "Create New Internship";

        if (Auth::user()->role_id == '1') {
            $facilities = Facility::all();
        } else {
            $facilities = Facility::where('id', Auth::user()->profile->facility_id)->get();
        }

        return view('internships.create', compact('title', 'facilities'));

    }

    public function store(Request $request)
    {
        try {
            $internship = new Internship;
            $internship->title = $request->title;
            $internship->qualifications = $request->qualifications;
            $internship->facility_id = $request->facility_id;
            $internship->responsibilities = $request->responsibillities;
            $internship->duration = $request->duration;

            if (empty($request->status)) {
                $internship->status = 0;
            } else {
                $internship->status = $request->status;
            }
            $internship->created_at = Carbon::now();

            $internship->save();

            flash('Internship created successfully!')->success();
            return redirect()->route('internships.index');
        } catch (\Exception $e) {
            flash('Failed!')->success();
            return $e;
        }

    }

    public function show(Internship $internship)
    {
        return back();
    }

    public function edit(Internship $internship)
    {
        $title = "Add Supervisor";

        if (Auth::user()->role_id == '1') {
            $users = UserSummary::where('role', 'Practitioner')->get();
        } else {
            $users = UserSummary::where('role', 'Practitioner')->where('facility_id', Auth::user()->facility_id )->get();
        }

        return view('student_internship.edit', compact('title', 'student', 'users'));
        
    }

    public function update(Internship $internship, Request $request)
    {
        $student->update($request->all());
        flash('Student updated successfully!')->success();
        return back();

    }

    public function destroy(Internship $internship)
    {

    }


}
