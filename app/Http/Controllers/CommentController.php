<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
        function create($userId,$postId,Request $request){
            $post=Posts::find($postId);
            $user=User::find($userId);
            $val=Validator::make($request->all(),[
                "text"=>"required|min:1"
            ]);
            
            if(!isset($post)){
                return response()->json([
                    "status"=>404,
                    "errors"=>"The Post Doesnt Exist!"
                ],404);
            }
            if(!isset($user)){
                return response()->json([
                    "status"=>404,
                    "errors"=>"You Should Be Authenticated"
                ],404);
            }
            if($val->fails()){
                return response()->json([
                    "status"=>402,
                    "errors"=>$val->messages()->toJson()
                ],402); 
            }
            $comment=new Comment();
            $comment->text=$request["text"];
            $comment->user_id=$userId;
            $comment->post_id=$postId;
            $comment->save();
            return response()->json([
                "status"=>200,
                "message"=>"The Comment Created Successfully!"
            ],200);
        }
        function delete($commentId){
            $comment=Comment::find($commentId);
            if(!isset($comment)){
                return response()->json([
                    "status"=>404,
                    "errors"=>"The Comment Doesnt Exist!"
                ],404);
            }

            $comment->delete();
            return response()->json([
                "status"=>200,
                "message"=>"The Comment Deleted Successfully!"
            ],200);
        }
        function show($commentId){
            $comment=Comment::find($commentId);
            if(!isset($comment)){
                return response()->json([
                    "status"=>404,
                    "errors"=>"The Comment Doesnt Exist!"
                ],404);
            }
            return response()->json([
                "status"=>200,
                "comment"=>$comment
            ],200);
        }
        function update($commentId,Request $request){
            $comment=Comment::find($commentId);
            $val=Validator::make($request->all(),[
                "text"=>"required|min:1"
            ]);
            if(!isset($comment)){
                return response()->json([
                    "status"=>404,
                    "errors"=>"The Comment Doesnt Exist!"
                ],404);
            }
            if($val->fails()){
                return response()->json([
                    "status"=>402,
                    "errors"=>$val->messages()->toJson()
                ],402); 
            }
 

            $comment->text=$request["text"];

            $comment->update();
            return response()->json([
                "status"=>200,
                "message"=>"The Comment Updated Successfully!"
            ],200);
        }
}
