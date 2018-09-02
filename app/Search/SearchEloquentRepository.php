<?php
namespace App\Search;

use App\Profile;
use Illuminate\Database\Eloquent\Collection;

class SearchEloquentRepository implements SearcbRepository
{
    public function search(string $query = ""): Collection
    {
        $me = auth()->user()->profile;
        $matches = Profile::whereIn('gender_id', $me->seeking)->get();
        return $matches;
    }
}