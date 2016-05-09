<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $primaryKey = 'publisher_id';

    protected $fillable = [
    	'publisher_name', 
    	'publisher_address', 
    	'publisher_logo',
    	'publisher_url',
    	'slug'
    ];

    public function topics() {
    	return $this->hasMany('App\Topic', 'publisher_id', 'publisher_id')->published()->available()->orderBy('topic_title'); // $this->hasMany('Model', 'foreign_key', 'local_key');
    }

    public static function show($slug, $publisher_id)
    {
        return Publisher::where([['slug', $slug], ['publisher_id', $publisher_id]])->firstOrFail();
    }

}
