<?php

namespace App;

use App\Search\Searchable;
use App\Services\GeotoolsService;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use Searchable, HasUuid;

    public $incrementing = false;

    protected $fillable = ['user_id', 'title', 'summary', 'description', 'location'];
    protected $with = ['gender', 'seeking', 'likedBooks', 'hatedBooks', 'books'];

    protected $appends = [
        'gender_value',
        'gender_seeking',
        'book_preference_likes',
        'book_preference_hates',
        'musicians_likes',
        'movies_likes',
    ];

    protected $hidden = ['gender_name', 'seeking'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function seeking()
    {
        return $this->belongsToMany(Gender::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public function likedBooks()
    {
        return $this->belongsToMany(Book::class)->wherePivot('type', 1);
    }

    public function hatedBooks()
    {
        return $this->belongsToMany(Book::class)->wherePivot('type', 2);
    }

    public function getGenderValueAttribute()
    {
        return $this->gender->gender;
    }

    public function getGenderSeekingAttribute()
    {
        return $this->seeking->pluck('gender');
    }

    public function getBookPreferenceLikesAttribute()
    {
        return $this->likedBooks->map(function($book){
            return "{$book->title} - {$book->author}";
        });
    }

    public function getBookPreferenceHatesAttribute()
    {
        return $this->hatedBooks->map(function($book){
            return "{$book->title} - {$book->author}";
        });
    }

    public function getMoviesLikesAttribute()
    {
        return $this->movies->pluck('title');
    }

    public function getMusiciansLikesAttribute()
    {
        return $this->musicians->pluck('artist');
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class);
    }

    public function getDistanceAttribute()
    {
        $geotools = GeotoolsService::create();
        return $geotools->distanceToLocation($this->location);
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    public function musicians()
    {
        return $this->belongsToMany(Musician::class);
    }



}
