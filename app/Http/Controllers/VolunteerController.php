<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Status;
use App\Models\VolunteerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function profile_show(){
        // post section
        $id = Auth::user()->id;
        $statuss = Status::where('assigned_to', '=',$id)
                            ->where('status','!=',"pending")->get();
        $posts = array();
        foreach($statuss as $status){
            array_push($posts,Post::find($status['post_id']));
        }
        //! post section
        // volunteer_service_type section
            $this_volunteer_service_types =  VolunteerService::where("user_id",'=',Auth::user()->id)->get();
            $volunteer_service_type = null;
        // !volunteer_service_type section
        $posts = array_reverse($posts);
        return view('volunteerprofile', ['posts' => $posts,'volunteer_service_types'=>$this_volunteer_service_types,'edit_volunteer_service_type'=>$volunteer_service_type]);
    }
}
