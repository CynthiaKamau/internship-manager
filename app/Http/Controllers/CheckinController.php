<?php

namespace App\Http\Controllers;
use App\Models\Checkin;
use Illuminate\Http\Request;
use DataTables;

class CheckinController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $checkins = Checkin::with(['user'])->get();
    
            $checkins = $checkins->map(function ($checkin) {

                $location = $this->getAddress($checkin->lat,$checkin->long);

                return [
                    'id' => $checkin->id,
                    'location' => $location,
                    'student' => $checkin->user->first_name. ' ' .$checkin->user->first_name,
                    'supervisor' => $checkin->supervisor === null ? '' : $checkin->supervisor->first_name. ' ' .$checkin->supervisor->last_name  ,
                    'created_at' => $checkin->created_at,
                ];
            });

            return Datatables::of($checkins)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('checkins.index');

    }

    protected function getAddress($RG_Lat,$RG_Lon)
    {

        $json = "https://nominatim.openstreetmap.org/reverse?format=json&lat=".$RG_Lat."&lon=".$RG_Lon."&zoom=27&addressdetails=1";

        $ch = curl_init($json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:59.0) Gecko/20100101 Firefox/59.0");
        $jsonfile = curl_exec($ch);
        curl_close($ch);

        $RG_array = json_decode($jsonfile,true);

        return $RG_array['display_name'];
        //return $RG_array['address']['city'];
        // $RG_array['address']['country'];

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
