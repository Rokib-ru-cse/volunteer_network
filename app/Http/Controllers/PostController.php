<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    

    public function search(Request $request){
        $queryString = $request->search;
        $allpost = Post::where('title', 'LIKE', "%$queryString%")
        ->orWhere('service_type','LIKE','%'.$queryString.'%')
        ->orderBy('id','DESC')->get();
        return view('home',['posts'=>$allpost]);
    }


    public function profile_show(Request $request)
    {  

           $id =Auth::user()->id;
           $allpost = Post::where("user_id",'=',$id)->orderBy('id','DESC')->get();
           return view('profile',['posts'=>$allpost]);
           
    }

    public function postdetail(Request $request,$id){
        $post = Post::find($id);
        return view('postdetail',['post'=>$post]);
    }

    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->user_id =Auth::user()->id;
        $post->email = $request->email;
        $post->word= $request->word;
        $post->phone= $request->phone;
        $post->service_type= $request->service_type;
        $post->description = $request->description; 
        $post->save();
        return redirect()->route('profile')->with('status', 'Blog Post Form Data Has Been inserted');
    }
    public function edit(Request $request, $id)
    {
        $post = Post::find($id);
        return view('edit',['post'=>$post]);
    }
    public function editpost(Request $request, $id)
    {

        $data= Post::find($id);
        $data['title'] = $request->title;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['service_type'] = $request->service_type;
        $data['word'] = $request->word;
        $data['description'] = $request->description;
        $data->save();
        return redirect()->route('profile');
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('profile');
    }

}
