<?php

namespace App\Http\Controllers;
use App\Models\Checkin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use DataTables;

class CheckinController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {

            if(Auth::user()->role_id == '1') {

                $checkins = Checkin::with(['user', 'facility'])->get();

            } else {

                $checkins = Checkin::with(['user', 'facility'])->where('facility_id' , Auth::user()->profile->facility_id)->get();
                
            }
    
            $checkins = $checkins->map(function ($checkin) {

                $location = $this->getAddress($checkin->lat,$checkin->long);

                $actions = '<div class="text-center text-uppercase">';

                $actions .= '<a href="' . route('checkins.edit', [$checkin]) . '" class="btn btn-sm btn-success">Approve</a>';

                $actions .= '</div>';

                if($checkin->approved == 1) {
                    $approved = "Approved";
                } else {
                    $approved = "Not Approved";
                }

                return [
                    'id' => $checkin->id,
                    'location' => $location,
                    'approved' => $approved,
                    'student' => $checkin->user->first_name. ' ' .$checkin->user->first_name,
                    'supervisor' => $checkin->supervisor === null ? '' : $checkin->supervisor->first_name. ' ' .$checkin->supervisor->last_name  ,
                    'facility' => $checkin->facility === null ? '' : $checkin->facility->name ,
                    'created_at' => Carbon::parse($checkin->created_at)->format('M d Y'),
                    'action' => $actions
                ];
            });


            return Datatables::of($checkins)
            ->addIndexColumn()
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
        $checkin->load(['user', 'supervisor']);
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
