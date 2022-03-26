<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function userlist()
    {
        $users = User::where("type", '=', "user")->orderBy('id', 'DESC')->get();
        return view('userlist', ['users' => $users]);
    }
    public function volunteerlist()
    {
        $volunteers = User::where("type", '=', "volunteer")->orderBy('id', 'DESC')->get();
        return view('volunteerlist', ['volunteers' => $volunteers]);
    }
    public function deleteuser($id)
    {
        $user = User::find($id);
        if ($user->type == "user") {
            $user->delete();
            return redirect()->route('userlist');
        }
        $user->delete();
        return redirect()->route('volunteerlist');
    }

    public function userposts($id){
        $posts = Post::where('user_id','=',$id)->orderBy('id', 'DESC')->get();
        return view('home', ['posts' => $posts]);
    }

    public function volunteerposts($id){
        $posts = Post::where('user_id','=',$id)->orderBy('id', 'DESC')->get();
        return view('home', ['posts' => $posts]);
    }


}
