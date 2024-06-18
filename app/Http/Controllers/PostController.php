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
          
            if($request->input('content') || $request->hasFile('image_url') || $request->hasFile('video_url')){
                $val=Validator::make($request->all(),[
                'content'=>$request->input('content') != null ? 'sometimes|min:5' : '',
                'image_url'=>$request->image_url != null ? 'sometimes|min:5' : '',
                'video_url'=>$request->video_url != null ? 'sometimes|min:5' : '',
                ]);
                if($val->fails()){                    
                        response()->json([
                            'status'=>422,
                            'errors'=>$val->messages()->toArray(),
                        ],422);
                }else{
                    $post= new Posts;
                    if($request->input('content') != null){
                        $post->content=$request->input('content');
                    }           
                    $post->user_id=$id;
                    
                    if($request->hasFile('image_url')){
                        $post->image_url=$request->image_url->getClientOriginalName();              
                        $request->image_url->storeAs('public/postImage',$post->image_url);
                    }
                    if($request->hasFile('video_url')){
                        $post->video_url=$request->video_url->getClientOriginalName();              
                        $request->video_url->storeAs('public/postVideo',$post->video_url);
                    }
                    $post->liked_users=json_encode([]);
                    $post->shared_users=json_encode([]);
                    $post->save();
                    return response()->json([
                        'message'=>'The Post created successfuly',
                        'Post'=>$post],201);
                    
                }
            }else{

                return response()->json([
                    'status'=>404,
                    'errors'=>'There is no content or image or video',
                ],404);
              
            }
           
        }
        return response()->json([
            'status'=>404,
            'errors'=>'user not found',
        ],404);
    }
    function show( $id){
        $post=Posts::find($id);
        if(!$post){
           
                return redirect('/')->with('error',[response()->json([
                    'status'=>404,
                    'errors'=>'The wanted Post doesnt exist',
                ],404)]);
        }else{
            
            return redirect('/')->with('response',[response()->json([
                'status'=>200,
                'Post'=>$post],200)]);
        }
    }
    function edit($id){
        $post=Posts::find($id);
        if(!$post){
                 
            return redirect('/')->with('error',[response()->json([
                'status'=>404,
                'errors'=>'The wanted Post doesnt exist',
            ],404)]);
        }else{
            return redirect('/')->with('response',[response()->json([
                'status'=>200,
                'Post'=>$post],200)]);
        }
    }
    function update(Request $request, int $postId){
        $val=Validator::make($request->all(),[
            'content'=>$request->input('content') != null ? 'sometimes|min:5' : '',
            'image_url'=>$request->image_url != null ? 'sometimes|min:5' : '',
            'video_url'=>$request->video_url != null ? 'sometimes|min:5' : '',
        ]);
        if($val->fails()){
            return response()->json([
                'status'=>'422',
                'errors'=>$val->messages()
            ],422);
        }else{
            $post=Posts::find($postId);

                if($post ){
                    if($request->input('content') || $request->hasFile('image_url') || $request->hasFile('video_url')){
                        if($request->input('content')){
                            $post->content=$request->input('content');
                        }           
                   
                        if($request->hasFile('image_url')){
                            $post->image_url=$request->image_url->getClientOriginalName();              
                            $request->image_url->storeAs('public/postImage',$post->image_url);
                        }
                        if($request->hasFile('video_url')){
                            $post->video_url=$request->video_url->getClientOriginalName();              
                            $request->video_url->storeAs('public/postVideo',$post->video_url);
                        }
                        $post->update();

                        return redirect('/')->with('response',[response()->json([
                            'message'=>'The Post updated successfuly',
                            'Post'=>$post],200)]);
                    }else{
                        return redirect('/')->with('error',[response()->json([
                            'status'=>404,
                            'errors'=>'There is no content or image or video',
                        ],404)]);
                                                   
                    }
                    
                }else{
                    return redirect('/')->with('error',[response()->json([
                        'status'=>404,
                        'errors'=>'The wanted Post doesnt exist',
                    ],404)]);
                }
        }
    }
    function delete($id){
        $post=Posts::find($id);
        if($post){
            $post->delete();
            return redirect('/')->with('response',[response()->json([
                'message'=>'The Post deleted successfuly',
                'status'=>200],200)]);

        }else{
            return redirect('/')->with('error',[response()->json([
                'status'=>404,
                'errors'=>'The wanted Post doesnt exist',
            ],404)]);
        }
    }
    function user($id){
        $post=Posts::find($id);
        if($post){
           
            return redirect('/')->with('response',[response()->json([
                'status'=>200,
                'user'=>$post->user],200)]);

        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Post doesnt exist',
            ],404);
        }
    }

    function postLike(Request $request,$postId,$userId){
        $post=Posts::find($postId);
        if($request->input('situation') == 'Liked'){
            $post->likes +=1;
            $liked_users=json_decode($post->liked_users);
            
            array_push($liked_users,$userId);
            $post->liked_users=json_encode($liked_users);
            $post->update();
            return response()->json([
                'status'=>200,
                'message'=>'Post Liked Successfuly'
            ],200);
        }else{
            $post->likes -=1;
            $liked_users=json_decode($post->liked_users);

            for($i=0;$i<count($liked_users);$i++){
                if($liked_users[$i] == $userId){
                    unset($liked_users[$i]);
                }
            }
            $post->liked_users=json_encode($liked_users);
            $post->update();
            return response()->json([
                'status'=>200,
                'message'=>'Post UnLiked Successfuly'
            ],200);
        }
    }
        function getLikes($id){
            $post=Posts::find($id);
            return $post->liked_users;
        }
    function all(){
        // $posts=Posts::all();
        $posts = Posts::orderBy('created_at', 'desc')->get();
        return response()->json([
            "posts"=>$posts
        ],200);
    }
    function getComments($id){
        $post=Posts::find($id);
        if(!isset($post)){
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted Post doesnt exist',
            ],404);
        }
        return response()->json([
            'status'=>200,
            'comments'=>$post->comments,
        ],200);
               
    }
}
