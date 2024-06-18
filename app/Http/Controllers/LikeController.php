<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    function create($userId,$postId){
        $user=User::find($userId);
        $post=Posts::find($postId);
        if(!isset($post)){
            return response()->json([
                "status"=>404,
                "errors"=>"The Post Doesnt Exist!"
            ],404);
        }
        if(!isset($user)){
            return response()->json([
                "status"=>404,
                "errors"=>"The User Doesnt Exist!"
            ],404);
        }
        $like=new Like();
        $like->user_id=$userId;
        $like->post_id=$postId;
        $like->save();
        return response()->json([
            "status"=>200,
            "message"=>"The User Liked  The Post Successfuly!"
        ],200);
    }
    function delete($userId,$postId){
        $user=User::find($userId);
        $post=Posts::find($postId);
        $like=Like::where("user_id",$userId)->where("post_id",$postId)->first();
        if(!isset($post)){
            return response()->json([
                "status"=>404,
                "errors"=>"The Post Doesnt Exist!"
            ],404);
        }
        if(!isset($user)){
            return response()->json([
                "status"=>404,
                "errors"=>"The User Doesnt Exist!"
            ],404);
        }
        if(!isset($like)){
            return response()->json([
                "status"=>404,
                "errors"=>"The Like Doesnt Exist!"
            ],404);
        }
        
        $like->delete();
        return response()->json([
            "status"=>200,
            "message"=>"The User Unliked The Post Successfuly!"
        ],200);
    }
}
