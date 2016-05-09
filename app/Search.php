<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $primaryKey = 'search_id';

    protected $fillable = [
        'search_query'
    ];

    public static function store($query, $count)
    {
        $search = new Search;
        $search->search_query = $query;
        $search->search_count = $count;
        $search->save();
        
        return $search;
    }

}
