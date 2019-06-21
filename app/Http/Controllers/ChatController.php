<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat_Message;
use App\Chat;
use App\User;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $user = $request->user;
        $chat = $request->chat;
        $message = $request->text;

        $inuser1 = Chat::find($chat)->user1;

        if($inuser1 == $user){
            $name = User::find($inuser1)->first_name;
        } else {
            $name = User::find($user)->first_name;
        }
        
        $data = array(
            'chat_id' => $chat,
            'sender_id' => $user,
            'message' => $message,
        );
        $all = new Chat_Message();
        $all->create($data);
        $datas = array(
            'user' => $name,
            'message' => $message,
        );

        return $datas;
    }

    public function isTyping(Request $request)
    {   
        $user = $request->user;
        $chat = $request->chat;
        
        $chat = Chat::find($chat);

        if($chat->user1 == $user){
            $chat->user1_is_typing = 1;
        } else {
            $chat->user2_is_typing = 1;
        }
        $chat->save();
    }

    public function notTyping(Request $request)
    {
        $user = $request->user;
        $chat = $request->chat;
        
        $chat = Chat::find($chat);

        if($chat->user1 == $user){
            $chat->user1_is_typing = 0;
        } else {
            $chat->user2_is_typing = 0;
        };
        $chat->save();
    }

    public function retrieveChatMessages(Request $request)
    {   
        $user = $request->user;
        $chat = $request->chat;
   
        $messages = Chat_Message::where('chat_id',$chat)->where('read',false)->get();
        foreach($messages as $message){
        if (count($messages) > 0 AND $message->sender_id != $user)
        {
            $message->read = 1;
            $messages[0]->save();       
        $inuser1 = Chat::find($chat)->user1;
        $user2 = Chat::find($chat)->user2;
        if($inuser1 == $user){
            $name = User::find($user2)->first_name;
        } else {
            $name = User::find($inuser1)->first_name;
        }
        $data[] = array(
            'message' => $message->message,
            'sender' => $name
        );
        return $data;
        }
        }
    }

    public function retrieveExistingMessages(Request $request)
    {   
        $user = $request->user;
        $chat = $request->chat;
        $messages = Chat_Message::where('chat_id',$chat)->get();
        foreach($messages as $message){
        $name = User::find($message->sender_id)->first_name;
        $data[] = array(
            'message' => $message->message,
            'unread' => $message->read,
            'user' => $name
        );
    
        // return $message->chat_id;
        // if (count($message) > 0 AND $message->sender_id != $user)
        // {     


        // return 'hello';
        // }
        }
        return $data;
    }

    public function retrieveTypingStatus(Request $request)
    {
        $user = $request->user;
        $chat = $request->chat;
        
        $chat = Chat::find($chat);

        if($chat->user1 == $user){
            if ($chat->user2_is_typing)
                return $chat->hasUser2->first_name;
        } else {
            if ($chat->user1_is_typing)
                return $chat->hasUser1->first_name;
        }
    }
}
