<?php

namespace App\Http\Controllers;
use App\Models\Checkin;
use Illuminate\Http\Request;

class CheckinController extends Controller
{

    public function index(Request $request)
    {
        if($request->has('search')) {
            $checkins = Checkins::with(['user'])->where('name', 'like', '%'.$request->search.'%')->paginate(setting('record_per_page', 15));
        } else {
            $checkins = Checkins::with(['user'])->paginate(setting('record_per_page', 15));
        }

        $title = "Manage Checkins";

        return view('checkins.index', compact('checkins', 'title'));
    }

    public function edit(Checkins $checkins)
    {
        $title = "Approve Checkin";
        $checkins->with('user');
        return view('checkins.edit', compact('title', 'checkins'));

    }

    public function update(Request $request, Checkins $checkins)
    {
        $checkins->update($request->all());
        flash('Checkin updated successfully!')->success();
        return back();
    }

    public function destroy(Checkins $checkins)
    {
        $checkins->delete();
        flash('Checkin deleted successfully!')->info();
        return back();
    }
    
}
