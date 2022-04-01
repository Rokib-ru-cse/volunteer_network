<?php

namespace App\Http\Controllers;

use App\Models\VolunteerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerServiceController extends Controller
{
    public function addvolunteer_service_type(Request $request){
        $new_volunteer_service_type = new VolunteerService();
        $new_volunteer_service_type->service_type = $request->service_type;
        $new_volunteer_service_type->user_id = Auth::user()->id;
        $new_volunteer_service_type->save();
        return redirect()->route('volunteerprofile','processing');
    }
    public function destroy_volunteer_service_type($id){
        $volunteer_service_type = VolunteerService::find($id);
        $volunteer_service_type->delete();
        return redirect()->route('volunteerprofile','processing');
    }
}
