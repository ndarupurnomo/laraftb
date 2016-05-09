<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $primaryKey = 'license_id';

    protected $fillable = [
    	'license_name', 
    	// 'license_abbr', 
    	'license_url',
    	'slug'
    ];

    public function topics() {
    	return $this->hasMany('App\Topic', 'license_id', 'license_id')->published()->available()->orderBy('topic_title'); // $this->hasMany('Model', 'foreign_key', 'local_key');
    }

    public static function show($slug, $license_id)
    {
        return License::where([['slug', $slug], ['license_id', $license_id]])->firstOrFail();
    }

}
