<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Post;

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
        return view('home', ['posts' => $allpost]);
    }
}
