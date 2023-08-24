<?php

namespace App\Http\Controllers;

use App\Models\Acheive;
use App\Models\Acheivements;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator ;

class acheiveController extends Controller
{
    function create(Request $request){
        $val=Validator::make($request->all(),[
            'name'=>'required|min:5|unique:acheivements',
            'description'=>'required|min:10',
            'requirementToAcheive'=>'required|min:15',
            'sportType'=>'required|min:5'
        ]);
        if($val->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$val->messages()
            ],422);
        }else{
            $a= new Acheivements;
            $a->name=$request->input('name');
            $a->image_url=$request->input('image_url');
            $a->video_url=$request->input('video_url');
            $a->description=$request->input('description');
            $a->requirementToAcheive=$request->input('requirementToAcheive');
            $a->sportType=$request->input('sportType');
            $a->save();

            return response()->json([
                'message'=>'Acheivement created successfuly',
                'Acheivement'=>$a
            ]);
        }
    }
    function show( $id){
        $ach=Acheivements::find($id);
        if(!$ach){
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted acheivement doesnt exist'],404);
        }else{
            return response()->json([
                'status'=>200,
                'Acheivement'=>$ach
            ],200);
        }
    }
    function edit($id){
        $ach=Acheivements::find($id);
        if(!$ach){
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted acheivement doesnt exist'],404);
        }else{
            return response()->json([
                'status'=>200,
                'Acheivement'=>Acheivements::find($id)
            ],200);
        }
    }
    function update(Request $request, int $id){
        $val=Validator::make($request->all(),[
            'name'=>'required|min:5',
            'description'=>'required|min:10',
            'requirementToAcheive'=>'required|min:15',
            'sportType'=>'required|min:5'
        ]);
        if($val->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$val->messages()
            ],422);
        }else{
            $ach=Acheivements::find($id);

                if($ach){
                    $ach->name=$request->input('name');
                    $ach->image_url=$request->input('image_url');
                    $ach->video_url=$request->input('video_url');
                    $ach->description=$request->input('description');
                    $ach->requirementToAcheive=$request->input('requirementToAcheive');
                    $ach->sportType=$request->input('sportType');
                    $ach->update();
        
                    return response()->json([
                        'status'=>200,
                        'message'=>'Acheivement updated successfuly',
                        'Acheivement'=>$ach
                    ],200);
                }else{
                    return response()->json([
                        'status'=>404,
                        'errors'=>'The wanted acheivement doesnt exist'
                    ],404);
                }
        }
    }
    function delete($id){
        $ach=Acheivements::find($id);
        if($ach){
            $ach->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Acheivement deleted successfuly',
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'errors'=>'The wanted acheivement doesnt exist'
            ],404);
        }
    }
    function users($id){
        $user=Acheivements::find($id)->users->all();
        $users =array();
    
        for($i=0;$i < count($user); $i++)
        {
            $get=User::find($user[$i]->user_id);
            array_push($users, $get);
        }    
        return $users;
    }
    function getAcheiv($acheivId,$userId){
        $new= new Acheive;
        $new->acheivements_id=$acheivId;
        $new->user_id=$userId;
        $new->save();
        return response()->json([
            'Message'=>'The user get the acheivement successfuly'
        ]);
    }
}
