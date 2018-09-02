<?php

namespace App;

use App\Search\Searchable;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use Searchable;

    protected $fillable = ['title', 'author'];

    public $timestamps = false;


    public function toSearchArray()
    {
        return [
           'id' => $this->id,
           'book' => $this->title . ' - ' . $this->author,
            'title' => $this->title,
            'author' => $this->author
        ];
    }

}
