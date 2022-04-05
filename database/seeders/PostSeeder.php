<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        $posts = [
            [
                'user_id'=>User::where('email','=','user1@gmail.com')->get()[0]['id'],
                'email'=>'user1@gmail.com',
                'location_id'=>User::where('email','=','user1@gmail.com')->get()[0]['location_id'],
                'gender'=>'male',
                'phone'=>'12345678901',
                'service_type_id'=>'1',
                'address'=>'rajshahi university',
                'description'=>'sometext'
            ],
        ];
        foreach($posts as $post){
            Post::create([
                'user_id'=>$post['user_id'],
                'service_type_id'=>$post['service_type_id'],
                'email'=>$post['email'],
                'gender'=>$post['gender'],
                'phone'=>$post['phone'],
                'location_id'=>$post['location_id'],
                'address'=>$post['address'],
                'description'=>$post['description'],
            ]);
        }
        $posts = Post::all();
        Status::truncate();
        foreach($posts as $post){
            $newstatus  = new Status();
            $newstatus->post_id = $post->id;
            $newstatus->save();
        }
    }
}
