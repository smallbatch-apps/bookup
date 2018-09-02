<?php

namespace App\Http\Controllers\Conversation;

use App\Conversation;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class ConversationMessageController extends Controller
{
    public function store($conversationId, Request $request){

        $conversation = Conversation::with('participants')->find($conversationId);

        $recipient_id = $conversation->participants->filter(function($participant){
            return $participant->id != auth()->user()->profile->id;
        })->first()->id;

        $message = Message::create([
            'conversation_id' => $conversationId,
            'sender_profile_id' => auth()->user()->profile->id,
            'recipient_profile_id' => $recipient_id,
            'content' => $request->get('message')
        ]);

        MessageSent::dispatch($message);

        return $message;
    }
}