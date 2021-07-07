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

        foreach($checkins as $value){
            return $this->getAddress($value->lat,$value->long);
        }

        //return view('checkins.index', compact('checkins', 'title'));
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
