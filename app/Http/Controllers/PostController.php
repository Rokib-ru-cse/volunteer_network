<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Status;
use App\Models\VolunteerService;

class PostController extends Controller
{
    //


    public function filter(Request $request)
    {
        $filter = $request->filter;
        $word = Auth::user()->word;
        if (Auth::user()->type == "admin") {
            $allpost = Post::where('service_type','=',$filter)
                            ->orderBy('id', 'DESC')->get();
            return view('home', ['posts' => $allpost]);
        }
        if (Auth::user()->type == "volunteer") {
            $service_types = VolunteerService::where('user_id','=',Auth::user()->id)->get();
            $allpost = Post::where('gender','=','any')
            ->orwhere('gender','=',Auth::user()->gender)
            ->where('word', '=', $word)
            ->where('service_type','=',$filter)
            ->orderBy('id', 'DESC')->get();
        $statuss = Status::where('status','=','pending')
        ->orwhere('status','=','rejected')
        ->where('assigned_to','!=',Auth::user()->id)->get();
        
        $newallposts = array();
        $a = null;
        foreach($allpost as $post){
            foreach($service_types as $service_type){
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
        $a = null;
        $posts = array();
        foreach($newallposts as $post){
            foreach($statuss as $status){
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
        $allpost = Post::where('user_id','=',Auth::user()->id)
            ->where('word', '=', $word)
            ->where('service_type','=',$filter)
            ->orderBy('id', 'DESC')->get();
        $statuss = Status::where('status','=','pending')->get();
        $posts = array();
        $a=null;
        foreach($allpost as $post){
            foreach($statuss as $status){
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


    public function profile_show($param)
    {
        $id = Auth::user()->id;
        $allpost = Post::where("user_id", '=', $id)->orderBy('id', 'DESC')->get();
        $statuss = Status::where('status','=',$param)->get();
        $posts = array();
        foreach($allpost as $post){
            foreach($statuss as $status){
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
        return view('profile', ['posts' => $posts]);
    }

    public function postdetail(Request $request, $id)
    {
        $post = Post::find($id);
        return view('postdetail', ['post' => $post]);
    }

    public function store(Request $request)
    {
        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->email = $request->email;
        $post->word = $request->word;
        $post->gender = $request->gender;
        $post->phone = $request->phone;
        $post->service_type = $request->service_type;
        $post->address = $request->address;
        $post->description = $request->description;
        $post->save();
        $newstatus  = new Status;
        $newstatus->post_id = $post->id;
        $newstatus->save();
        return redirect()->route('home');
    }
    public function edit(Request $request, $id)
    {
        $post = Post::find($id);
        return view('edit', ['post' => $post]);
    }
    public function editpost(Request $request, $id)
    {

        $data = Post::find($id);
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['service_type'] = $request->service_type;
        $data['word'] = $request->word;
        $data['gender'] = $request->gender;
        $data['address'] = $request->address;
        $data['description'] = $request->description;
        $data->save();
        return redirect()->route('profile','processing');
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('profile','processing');
    }
}
