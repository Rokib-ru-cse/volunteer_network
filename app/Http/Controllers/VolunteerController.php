<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function profile_show($param){
        $id = Auth::user()->id;
        $statuss = Status::where('assigned_to', '=',$id)
                            ->where('status','=',$param)->get();
        $posts = array();
        foreach($statuss as $status){
            array_push($posts,Post::find($status['post_id']));
        }
        return view('volunteerprofile', ['posts' => $posts]);
    }
}
