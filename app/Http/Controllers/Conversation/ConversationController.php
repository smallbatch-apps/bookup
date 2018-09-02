<?php

namespace App\Http\Controllers\Conversation;

use App\Conversation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        return auth()->user()->profile->conversations()->with('participants')->get()->map(function($conversation){
            $participant = $conversation->participants->filter(function($p){
                return $p->id  != auth()->user()->profile->id;
            })->first();

            return [
                'id' => $conversation->id,
                'participant_id' => $participant->id,
                'title' => $participant->title
            ];
        });
    }

    public function store(Request $request)
    {
        $conversation = Conversation::create();
        $conversation->participants()->attach(auth()->user()->profile->id);
        $conversation->participants()->attach($request->get('profileId'));

        return $conversation;
    }

    public function show($id)
    {
        $conversations = auth()->user()->profile->conversations()->with('messages')->get()->filter(function($conversation) use ($id) {
            return $conversation->id == $id;
        });

        if ($conversations->isEmpty()) {
            return abort(401);
        }

        return $conversations->first();
    }
}
