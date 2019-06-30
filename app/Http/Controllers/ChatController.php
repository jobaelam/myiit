<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat_Message;
use App\Chat;
use App\User;

class ChatController extends Controller
{
    public function displayMessages(Request $request){
        $user = $request->user1;
        $conversationExist = Chat::where('user1', $user)->orwhere('user2', $user)->orderby('created_at', 'desc')->get();
        foreach($conversationExist as $convo){
            $messages = Chat_Message::where('chat_id',$convo->id)->orderby('created_at', 'desc')->get();
            foreach($messages as $message){
                if($message->sender_id != $user){
                    $name = User::find($message->sender_id)->first_name;
                    $profilePicture = User::find($message->sender_id)->profile_image;
                } else {
                    $chatUser = Chat::where('id', $message->chat_id)->first();
                    if($chatUser->user1 == $user){
                        $name = User::find($chatUser->user2)->first_name;
                        $profilePicture = User::find($chatUser->user2)->profile_image;
                    } else {
                         $name = User::find($chatUser->user1)->first_name;
                         $profilePicture = User::find($chatUser->user1)->profile_image;
                    }
                }
                $data[] = array(
                    'message' => $message->message,
                    'user' => $name,
                    'sender' => $message->sender_id,
                    'unread' => $message->read,
                    'profilePicture' => $profilePicture,
                    'timeStamp' => date('d M h:i A',strtotime($message->created_at)),
                );
                break;
            }
        }
        return $data;
    }

    public function sendMessage(Request $request)
    {
        $sender = $request->user1;
        $receiver = $request->user2;
        $message = $request->text;
        $conversationExist = Chat::where([['user1', $sender],['user2', $receiver]])->orwhere([['user2', $sender],['user1', $receiver]])->first();
        if(!$conversationExist){
            try     
            {
                $conversationExist = Chat::create(array(
                                        'user1' => $sender,
                                        'user2' => $receiver,
                                    ));
            }
            catch(\Illuminate\Database\QueryException $e){
                // do what you want here with $e->getMessage();
            }
        }
        Chat_Message::create(array(
            'chat_id' => $conversationExist->id,
            'sender_id' => $sender,
            'message' => $message,
        ));
        $messageTimeStamp = Chat_Message::where('chat_id', $conversationExist->id)->orderby('created_at', 'desc')->first();
        $data = array(
            'sender' => User::find($sender)->first_name,
            'message' => $message,
            'timeStamp' => date('d M h:i A',strtotime($messageTimeStamp->created_at)),
        );

        return $data;
    }

    public function isTyping(Request $request)
    {   
        $user1 = $request->user1;
        $user2 = $request->user2;
        $conversationExist = Chat::where([['user1', $user1],['user2', $user2]])->orwhere([['user2', $user1],['user1', $user2]])->first();
        if($conversationExist->user1 == $user1){
            $conversationExist->user1_is_typing = 1;
        } else {
            $conversationExist->user2_is_typing = 1;
        }
        $conversationExist->save();
    }

    public function notTyping(Request $request)
    {
        $user1 = $request->user1;
        $user2 = $request->user2;
        $conversationExist = Chat::where([['user1', $user1],['user2', $user2]])->orwhere([['user2', $user1],['user1', $user2]])->first();
        if($conversationExist->user1 == $user1){
            $conversationExist->user1_is_typing = 0;
        } else {
            $conversationExist->user2_is_typing = 0;
        }
        $conversationExist->save();
    }

    public function retrieveChatMessages(Request $request)
    {   
        $user1 = $request->user1;
        $user2 = $request->user2;
        $conversationExist = Chat::where([['user1', $user1],['user2', $user2]])->orwhere([['user2', $user1],['user1', $user2]])->first();
        $messages = Chat_Message::where('chat_id',$conversationExist->id)->where('read',false)->get();
        if(count($messages)>0){
            foreach($messages as $message){
                if ($message->sender_id != $user1)
                {
                    $message->read = 1;
                    $message->save();       
                    $name = User::find($message->sender_id)->first_name;
                    $data[] = array(
                        'message' => $message->message,
                        'sender' => $name,
                        'timeStamp' => date('d M h:i A',strtotime($message->created_at)),
                    );
                }
            }
            return $data;
        }
    }

    public function retrieveExistingMessages(Request $request)
    {   
        $user1 = $request->user1;
        $user2 = $request->user2;
        $conversationExist = Chat::where([['user1', $user1],['user2', $user2]])->orwhere([['user2', $user1],['user1', $user2]])->first();
        if($conversationExist){
            $messages = Chat_Message::where('chat_id',$conversationExist->id)->get();
            foreach($messages as $message){
                $name = User::find($message->sender_id)->first_name;
                $data[] = array(
                    'message' => $message->message,
                    'user' => $name,
                    'timeStamp' => date('d M h:i A',strtotime($message->created_at)),
                );
            }
        }
        return $data;
    }

    public function retrieveTypingStatus(Request $request)
    {
        $user1 = $request->user1;
        $user2 = $request->user2;
        $conversationExist = Chat::where([['user1', $user1],['user2', $user2]])->orwhere([['user2', $user1],['user1', $user2]])->first();
        if($conversationExist){
            if($conversationExist->user1 == $user1){
                if ($conversationExist->user2_is_typing)
                    return $conversationExist->hasUser2->first_name;
            } else {
                if ($conversationExist->user1_is_typing)
                    return $conversationExist->hasUser1->first_name;
            }
        }
    }
}
