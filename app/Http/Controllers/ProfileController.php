<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile', [
            'profile' => auth()->user()->profile
        ]);
    }

    public function edit()
    {
        $profile = auth()->user()->profile;

        if ($profile->location) {
            list($coords['latitude'], $coords['longitude']) = explode(',', $profile->location);
        } else {
            $coords = [
              'latitude' => 0,
              'longitude' => 0
            ];
        }

        return view('profile.edit', [
            'profile' => $profile,
            'coords' => $coords
        ]);
    }

    public function update(Request $request)
    {
        auth()->user()->profile->update($request->all());
        return redirect()->route('profile');
    }

    public function show($id)
    {
        $conversationId = auth()->user()->profile->conversations->filter(function($conversation) use ($id) {
            return $conversation->participants->pluck('id')->contains($id);
        })->first()->id ?? false;

        $profile = Profile::find($id);

        return view('partials.profile', [
            'profile' => $profile,
            'conversationId' => $conversationId
        ]);
    }
}
