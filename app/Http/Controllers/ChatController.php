<?php

namespace App\Http\Controllers;

use App\Events\Chat;
use App\Models\Chats;
use App\Models\User;
use GPBMetadata\Google\Api\Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
   public function create($ownerid,$withUserId){
         $user=User::find($ownerid);
         $user2=User::find($withUserId);
         if(!isset($user) || !isset($user2)){
               return response()->json([
                  "status"=>404,
                  "erros"=>"User Doesnt Exist"
               ],404);
         }
         $chat= new Chats();
         $chat->ownerId=$ownerid;
         $chat->withUserId=$withUserId;
         $chat->chatLog=json_encode([]);
         $id=$chat->save();
         return $chat;

   }   

   public function getChats($ownerid,$withUserId){
      $user=User::find($ownerid);
      $user2=User::find($withUserId);
      if(!isset($user) || !isset($user2)){
            return response()->json([
               "status"=>404,
               "erros"=>"User Doesnt Exist"
            ],404);
      }

      $chat=Chats::where("ownerId",$ownerid)->where("withUserId",$withUserId)->first();

      if(!isset($chat)){
         $create=$this->create($ownerid,$withUserId);
         $chatsLog=json_decode($create->chatLog);
         $chatId=$create->id;
      }else{
         $chatsLog=json_decode($chat->chatLog);
         $chatId=$chat->id;
      }
  
      return response()->json([
         "status"=>200,
         "chat"=>$chatsLog,
         "id"=>$chatId
      ],200);
} 
   public function send(Request $request,$currentId,$receiverId){
      $chatUserSender=$this->getChats($currentId,$receiverId);
      $contentSender = $chatUserSender->getContent();
      $chatArraySender = json_decode($contentSender, true);

      $chatLogSender = $chatArraySender['chat'];
      $magSender=[];
      $user=User::find($currentId);
      $receiver=User::find($receiverId);
      $magSender["sender"]="You";
      $magSender["receiver"]=$receiver->name;
      $magSender["msg"]=$request->input('message');
      $magSender["time"]=$request->input('time');
      $chatLogSender[]=$magSender;
      $chatObj=Chats::find($chatArraySender['id']);
      $chatObj->chatLog=json_encode($chatLogSender);
      $chatObj->update();


      $chatUserReceiver=$this->getChats($receiverId,$currentId);
      $contentReceiver = $chatUserReceiver->getContent();
      $chatArrayReceiver = json_decode($contentReceiver, true);

      $chatLogReceiver = $chatArrayReceiver['chat'];
      $magReceiver=[];

      $magReceiver["sender"]=$user->name;
      $magReceiver["receiver"]="You";
      $magReceiver["msg"]=$request->input('message');
      $magReceiver["time"]=$request->input('time');
      $chatLogReceiver[]=$magReceiver;
      $chatObj2=Chats::find($chatArrayReceiver['id']);
      $chatObj2->chatLog=json_encode($chatLogReceiver);
      $chatObj2->update();

      event(new Chat($request->input('message'),$user,$receiver));


   }
   function getContact($userId){
      $chat=Chats::where("ownerId",$userId)->get();
      $contact=[];
      foreach($chat as $cont){
         $contactUserId=$cont->withUserId;
         $contactUserName=$cont->withUser->name;
         $contactUserImg=$cont->withUser->image_url;
         $chats=json_decode($cont->chatLog);
         if(count($chats) > 0){
            $lastMsg=$chats[count($chats) - 1]->msg;
            $contact[]=[$contactUserId,$lastMsg,$contactUserName,$contactUserImg];
         }else{
            $lastMsg="";
            $contact[]=[$contactUserId,$lastMsg,$contactUserName,$contactUserImg];
         }
      }
      return $contact;
   }   
}
