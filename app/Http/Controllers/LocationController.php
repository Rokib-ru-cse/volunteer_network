<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function location(){
        $alllocations = Location::all();
        $location = null;
        return view('location',['locations'=>$alllocations,'editlocation'=>$location]);
    }
    public function addlocation(Request $request){
        $newlocation = new Location();
        $newlocation->location = $request->location;
        $newlocation->save();
        return redirect()->route('location');
    }
    public function destroylocation($id){
        $location = Location::find($id);
        $location->delete();
        return redirect()->route('location');
    }
    public function editlocation($id){
        $location = Location::find($id);
        $alllocation = Location::all();
        return view('location',['locations'=>$alllocation,'editlocation'=>$location]);
    }
    public function elocation(Request $request,$id){
        $newlocation = Location::find($id);
        $newlocation->location = $request->location;
        $newlocation->save();
        return redirect()->route('location');
    }
}
