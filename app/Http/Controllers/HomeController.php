<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Status;
use App\Models\VolunteerService;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->type == "admin") {
            $allpost = Post::orderBy('id', 'DESC')->get();
            return view('home', ['posts' => $allpost]);
        }
        if (Auth::user()->type == "volunteer") {
            $location_id = Auth::user()->location_id;
            $volunteer_service_types = VolunteerService::where('user_id', '=', Auth::user()->id)->get();
            $allpost = Post::where('gender', '=', 'any')
                ->orwhere('gender', '=', Auth::user()->gender)
                ->where("location_id", '=', $location_id)->orderBy('id', 'DESC')->get();
                $statuss = Status::where('status', '=', 'pending')
                ->orwhere('status', '=', 'rejected')
                ->where('assigned_to', '!=', Auth::user()->id)->get();
            $newallposts = array();
            $a = null;
            foreach ($allpost as $post) {
                foreach ($volunteer_service_types as $volunteer_service_type) {
                    if ($volunteer_service_type['service_type_id'] == $post['service_type_id']) {
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
            $posts = array();
            $a = null;
            foreach ($newallposts as $post) {
                foreach ($statuss as $status) {
                    if ($status['post_id'] == $post['id']) {
                        $a = $post;
                        break;
                    } else {
                        $a = null;
                    }
                }
                if ($a != null) {
                    array_push($posts, $a);
                }
            }
            $posts = array_reverse($posts);
            return view('home', ['posts' => $posts]);
        }
        if (Auth::user()->type == "user") {
            $posts = Post::where('user_id','=',Auth::user()->id)->orderBy('id', 'DESC')->get();
            return view('home', ['posts' => $posts]);
        }
    }
}
