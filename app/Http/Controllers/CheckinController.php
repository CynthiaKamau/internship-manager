<?php

namespace App\Http\Controllers;
use App\Models\Checkin;
use Illuminate\Http\Request;

class CheckinController extends Controller
{

    public function index(Request $request)
    {
        if($request->has('search')) {
            $checkins = Checkin::with(['user'])->where('name', 'like', '%'.$request->search.'%')->paginate(setting('record_per_page', 15));
        } else {
            $checkins = Checkin::with(['user'])->paginate(setting('record_per_page', 25));
        }

        $title = "Manage Checkins";

        return view('checkins.index', compact('checkins', 'title'));
    }

    public function show(Checkin $checkin)
    {
        return back();
    }

    public function edit(Checkin $checkin)
    {
        $title = "Approve Checkin";
        $checkin->with('user');
        return view('checkins.edit', compact('title', 'checkin'));

    }

    public function update(Request $request, Checkin $checkin)
    {
        $checkin->update($request->all());
        flash('Checkin updated successfully!')->success();
        return back();
    }

    public function destroy(Checkin $checkin)
    {
        $checkin->delete();
        flash('Checkin deleted successfully!')->info();
        return back();
    }
    
}
