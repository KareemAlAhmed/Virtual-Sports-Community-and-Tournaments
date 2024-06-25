<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    function request($followerId,$followedId){
        $follower=User::find($followedId);
        $followed=User::find($followedId);
        if($followerId == $followedId){
            return response()->json([
                "status"=>404,
                "errors"=>"You Cant Follow YourSelf!"
            ],402);
        }
        $alreadySent=Follower::where("follower_id",$followerId)->where("followed_id",$followedId)->where("status","Pending")->first();
        $alreadyFriend=Follower::where("follower_id",$followerId)->where("followed_id",$followedId)->where("status","Accepted")->first();
        if(isset($alreadyFriend)){
            return response()->json([
                "status"=>402,
                "errors"=>"You Are Already Following The User!"
            ],402);
        }
        if(isset($alreadySent)){
            return response()->json([
                "status"=>402,
                "errors"=>"The Following Request Already Been Sent The User!"
            ],402);
        }

        if(!isset($follower)){
            return response()->json([
                "status"=>404,
                "errors"=>"The Follower User Doesnt Exist!"
            ],404);
        }
        if(!isset($followed)){
            return response()->json([
                "status"=>404,
                "errors"=>"The Followed User Doesnt Exist!"
            ],404);
        }
        $followReq= new Follower();
        $followReq->follower_id=$followerId;
        $followReq->followed_id=$followedId;
        $followReq->save();
        return response()->json([
            "status"=>200,
            "message"=>"The Following Request Has Been Sent."
        ],200);
    }

    function acceptReq($followedId,$followerId){
        $request=Follower::where("follower_id",$followerId)->where("followed_id",$followedId)->where("status","Pending")->first();
        if(!isset($request)){
            return response()->json([
                "status"=>404,
                "errors"=>"The Following Request Doesnt Exist!"
            ],404);
        }
        $request->status="Accepted";
        $request->update();
        return response()->json([
            "status"=>200,
            "message"=>"The Following Request Has Been Accepted."
        ],200);
    }
    function denyReq($followedId,$followerId){
        $request=Follower::where("follower_id",$followerId)->where("followed_id",$followedId)->where("status","Pending")->first();
        if(!isset($request)){
            return response()->json([
                "status"=>404,
                "errors"=>"The Following Request Doesnt Exist!"
            ],404);
        }
        $request->status="Denied";
        $request->update();
        return response()->json([
            "status"=>200,
            "message"=>"The Following Request Has Been Denied."
        ],200);
    }
    function cancelFollowing($followerId,$followedId){
        $alreadySent=Follower::where("follower_id",$followerId)->where("followed_id",$followedId)->first();
        if(!isset($alreadySent)){
            return response()->json([
                "status"=>404,
                "errors"=>"You Are Not Following The User!"
            ],404);
        }
        $alreadySent->delete();
        return response()->json([
            "status"=>200,
            "message"=>"The Following  Has Been Canceled."
        ],200);
    }

    function getUserFollower($userId){
        $user=User::find($userId);
        if(!isset($user)){
            return response()->json([
                "status"=>404,
                "errors"=>"The User Doesnt Exist!"
            ],404);
        }
        $users=[];
        foreach($user->followingUsers as $follower){
            $userF=User::find($follower->follower_id);
            array_push($users,$userF);
        }
        return response()->json([
            "status"=>200,
            "followers"=>$users
        ],200);
    }   
    function getUserFollowed($userId){
        $user=User::find($userId);
        if(!isset($user)){
            return response()->json([
                "status"=>404,
                "errors"=>"The User Doesnt Exist!"
            ],404);
        }
        $users=[];
        foreach($user->followedUsers as $follower){
            $userF=User::find($follower->followed_id);
            array_push($users,$userF);
        }

        return response()->json([
            "status"=>200,
            "following"=>$users
        ],200);
    }   
    function getUserFollowingRequests($userId){
        $user=User::find($userId);
        if(!isset($user)){
            return response()->json([
                "status"=>404,
                "errors"=>"The User Doesnt Exist!"
            ],404);
        }
        $users=[];
        foreach($user->followingRequests as $follower){
            $userF=User::find($follower->follower_id);
            array_push($users,$userF);
        }

        return response()->json([
            "status"=>200,
            "Users"=>$users
        ],200);
    }   

    function isFollowing($followerId,$followedId){
        $controller=new FollowerController();
        $data=$controller->getUserFollower($followedId)->getContent();
        $followers=json_decode($data,true);
        $isFollowing=false;
        if(isset($followers["followers"])){
            foreach($followers["followers"] as $user){
    
                if($user["id"] == $followerId){
                    $isFollowing=true;
                }
            } 
        }
        return $isFollowing;
    }
    function followRequested($followerId,$followedId){
        $alreadySent=Follower::where("follower_id",$followerId)->where("followed_id",$followedId)->where("status","Pending")->first();
        if(isset($alreadySent)){
            return true;
        }else{
            return false;
        }
    }
}
