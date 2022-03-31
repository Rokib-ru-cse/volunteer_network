<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function updatestatus(Request $request,$id){
        $post = Status::where('post_id',$id)->first();
        $post->status = $request->status;
        $post->assigned_to = Auth::id();
        $post->save();
        return redirect()->route('volunteerprofile','processing');
    }
}
