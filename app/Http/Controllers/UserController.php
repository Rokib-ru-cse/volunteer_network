<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Status;
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
        $allposts = Status::where('assigned_to', $id)->get();
        foreach ($allposts as $post) {
            if ($post->status != 'completed') {
                $post->status = 'pending';
                $post->save();
            }
        }
        if ($user->type == "user") {
            $user->delete();
            return redirect()->route('userlist');
        }
        $user->delete();
        return redirect()->route('volunteerlist');
    }

    public function userposts($id)
    {
        $posts = Post::where('user_id', '=', $id)->orderBy('id', 'DESC')->get();
        return view('userservicerelated', ['id' => $id, 'posts' => $posts]);
    }

    public function volunteerposts($id)
    {
        $statuss = Status::where('assigned_to', '=', $id)->get();
        $posts = array();
        foreach ($statuss as $status) {
            array_push($posts, Post::find($status['post_id']));
        }
        return view('userservicerelated', ['id' => $id, 'posts' => $posts]);
    }
    public function adminservices($id, $param)
    {
        if (User::find($id)->type == 'user') {
            $allpost = Post::where('user_id', '=', $id)->orderBy('id', 'DESC')->get();
            $statuss = Status::where('status', '=', $param)->get();
            $newallposts = array();
            $a = null;
            foreach ($allpost as $post) {
                foreach ($statuss as $status) {
                    if ($status['post_id'] == $post['id']) {
                        $a = $post;
                        break;
                    } else {
                        $a = null;
                    }
                }
                if ($a != null) {
                    array_push($newallposts, $a);
                }
            }
            return view('userservicerelated', ['id' => $id, 'posts' => $newallposts]);
        } else {
            $statuss = Status::where('assigned_to', '=', $id)
                ->where('status', '=', $param)->get();
            $posts = array();
            foreach ($statuss as $status) {
                array_push($posts, Post::find($status['post_id']));
            }
            return view('userservicerelated', ['id' => $id, 'posts' => $posts]);
        }
    }

    public function userdetails($id)
    {
        $user = User::find($id);
        return view('userdetails', ['user' => $user]);
    }
}
