<?php

namespace App\Http\Controllers;

use App\Models\VolunteerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerServiceController extends Controller
{
    public function addvolunteer_service_type(Request $request)
    {
        $service_exist = VolunteerService::where('service_type_id', '=', $request->service_type_id)
                                        ->where('user_id','=',Auth::user()->id)->get();
        if (count($service_exist)>0) {
            return redirect()->route('volunteerprofile',['error' => 'Already Added']);
        } else {
            $new_volunteer_service_type = new VolunteerService();
            $new_volunteer_service_type->service_type_id = $request->service_type_id;
            $new_volunteer_service_type->user_id = Auth::user()->id;
            $new_volunteer_service_type->save();
            return redirect()->route('volunteerprofile');
        }
    }
    public function destroy_volunteer_service_type($id)
    {
        $volunteer_service_type = VolunteerService::find($id);
        $volunteer_service_type->delete();
        return redirect()->route('volunteerprofile');
    }
}
