<?php

namespace App\Http\Controllers\Profile;

use App\Book;
use App\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileBooksController extends Controller
{
    public function index($type)
    {
        /** @var Profile $profile */
        $profile = auth()->user()->profile;

        if ($type == 'liked') {
            return ['books' => $profile->likedBooks];
        }
        return ['books' => $profile->hatedBooks];
    }

    public function delete($type, $id)
    {
        if ($type == 'liked') {
            auth()->user()->profile->likedBooks()->detach($id);
        }
        auth()->user()->profile->hatedBooks()->detach($id);

        return response(null, 200);
    }

    public function store($type, Request $request)
    {
        $type = $type == 'liked' ? 1 : 2;
        $bookId = $request->get('id');

        if($request->get('source') == 'google'){
            $book = Book::create($request->only(['title', 'author']));
            $bookId = $book->id;
        }

        auth()->user()->profile->books()->attach($bookId, [
            'type' => $type
        ]);

        return [
            'book' => Book::find($bookId)
        ];
    }
}
