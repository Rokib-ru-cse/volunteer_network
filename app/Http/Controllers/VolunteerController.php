<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Status;
use App\Models\VolunteerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function profile_show($param){
        // post section
        $id = Auth::user()->id;
        $statuss = Status::where('assigned_to', '=',$id)
                            ->where('status','=',$param)->get();
        $posts = array();
        foreach($statuss as $status){
            array_push($posts,Post::find($status['post_id']));
        }
        //! post section
        // volunteer_service_type section
            $all_volunteer_service_types = VolunteerService::all();
            $volunteer_service_type = null;
        // !volunteer_service_type section
        $posts = array_reverse($posts);
        return view('volunteerprofile', ['posts' => $posts,'volunteer_service_types'=>$all_volunteer_service_types,'edit_volunteer_service_type'=>$volunteer_service_type]);
    }
}
