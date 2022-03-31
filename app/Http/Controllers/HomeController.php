<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Status;

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
        $word = Auth::user()->word;
        $allpost = Post::where("word", '=', $word)->orderBy('id', 'DESC')->get();
        $statuss = Status::where('status','=','pending')->get();
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
        return view('home', ['posts' => $posts]);
    }
}
