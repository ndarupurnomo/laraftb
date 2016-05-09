<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'cover',
        'short_description',
        'long_description',
        'ISBN10',
        'ISBN13',
        'pages',
        'publication_date',
        'download_url',
        'webpage_url',
        'publisher_id'
    ];
    
    public static function show($slug, $id)
    {
        return Book::where([
            ['slug', $slug],
            ['id', $id],
        ])->firstOrFail();
    }    
}
