<?php

namespace App\Http\Controllers;

use App\Models\Acheivements;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    function create(Request $request,int $id){
        $user=User::find($id);
        if($user){
        
        $val=Validator::make($request->all(),[
            'title'=>'required|min:5|unique:posts',
            'content'=>'required|min:15',
        ]);
        if($val->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$val->messages()
            ],422);
        }else{
            $post= new Posts;
            $post->title=$request->input('title');
            $post->image_url=$request->input('image_url');
            $post->video_url=$request->input('video_url');
            $post->content=$request->input('content');
            $post->user_id=$id;
            $post->save();

            return response()->json([
                'message'=>'The Post created successfuly',
                'Acheivement'=>$post
            ]);
        }
    }
    }
    function show( $id){
        $post=Posts::find($id);
        if(!$post){
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Post doesnt exist'],404);
        }else{
            return response()->json([
                'status'=>200,
                'Post'=>$post
            ],200);
        }
    }
    function edit($id){
        $post=Posts::find($id);
        if(!$post){
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Post doesnt exist'],404);
        }else{
            return response()->json([
                'status'=>200,
                'Post'=>$post
            ],200);
        }
    }
    function update(Request $request, int $postId){
        $val=Validator::make($request->all(),[
            'title'=>'required|min:5',
            'content'=>'required|min:15',
        ]);
        if($val->fails()){
            return response()->json([
                'status'=>'422',
                'errors'=>$val->messages()
            ],422);
        }else{
            $post=Posts::find($postId);

                if($post ){
                    $post->title=$request->input('title');
                    $post->image_url=$request->input('image_url');
                    $post->video_url=$request->input('video_url');
                    $post->content=$request->input('content');
                    $post->user_id=$post->user_id;
                    $post->update();
        
                    return response()->json([
                        'status'=>200,
                        'message'=>'The Post updated successfuly',
                        'Acheivement'=>$post
                    ],200);
                }else{
                    return response()->json([
                        'status'=>404,
                        'errors'=>'The wanted Post doesnt exist'
                    ],404);
                }
        }
    }
    function delete($id){
        $post=Posts::find($id);
        if($post){
            $post->delete();
            return response()->json([
                'status'=>200,
                'message'=>'The Post deleted successfuly',
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Post doesnt exist'
            ],404);
        }
    }
    function user($id){
        $post=Posts::find($id);
        if($post){
            return response()->json([
                'status'=>200,
                'user'=>$post->user
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Post doesnt exist'
            ],404);
        }
    }
}
