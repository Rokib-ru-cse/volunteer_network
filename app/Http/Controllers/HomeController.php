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
            $posts = array_reverse($allpost);
            return view('home', ['posts' => $posts]);
        }
        if (Auth::user()->type == "volunteer") {
            $word = Auth::user()->word;
            $service_types = VolunteerService::where('user_id','=',Auth::user()->id)->get();
            $allpost = Post::where('gender','=','any')
                        ->orwhere('gender','=',Auth::user()->gender)
                        ->where("word", '=', $word)->orderBy('id', 'DESC')->get();
            $statuss = Status::where('status','=','pending')
                    ->orwhere('status','=','rejected')
                    ->where('assigned_to','!=',Auth::user()->id)->get();
            $newallposts = array();
            $a = null;
            foreach($service_types as $service_type){
                foreach($allpost as $post){
                    if($service_type['service_type']==$post['service_type']){
                        $a = $post;
                        break;
                    }else{
                        $a = null;
                    }
                }
                if($a!=null){
                    array_push($newallposts,$a);
                }
            }
            $posts = array();
            foreach($statuss as $status){
                foreach($newallposts as $post){
                    if($status['post_id']==$post['id']){
                        $a = $post;
                        break;
                    }else{
                        $a = null;
                    }
                }
                array_push($posts,$a);
            }
            $posts = array_reverse($posts);
            return view('home', ['posts' => $posts]);
        }

        $word = Auth::user()->word;
        $allpost = Post::where("word", '=', $word)->orderBy('id', 'DESC')->get();
        $statuss = Status::where('status','=','pending')
                    ->orwhere('status','=','rejected')->get();
        $posts = array();
        foreach($statuss as $status){
            foreach($allpost as $post){
                if($status['post_id']==$post['id']){
                    $a = $post;
                    break;
                }else{
                    $a = null;
                }
            }
            array_push($posts,$a);
        }
        $posts = array_reverse($posts);
        return view('home', ['posts' => $posts]);
    }
}
