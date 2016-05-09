<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
	protected $primaryKey = 'forum_id';
	// protected $table = 'forums';

    protected $fillable = [
        'forum_name',
        'forum_desc',
        'forum_order',
        'forum_sort',
        'cat_id',
        'slug'
    ];
    
    public function category() {
    	return $this->belongsTo('App\Category', 'cat_id', 'cat_id'); // $this->belongsTo('Model', local_key', 'parent_key')
    }

    public function topics() {
    	return $this->belongsToMany('App\Topic')
            ->select('topics.topic_id', 'topic_title', 'topic_time', 'topic_views', 'topic_description', 'topics.created_at', 'topics.updated_at', 
                'topic_cover', 'topic_ISBN10', 'topic_ISBN13', 'topic_pages', 'publisher_id', 'topic_publication_date', 'topic_download_url', 
                'license_id', 'topic_status', 'slug')
            ->published()
            ->available()
            ->withTimestamps();
        // ->withPivot('products_amount', 'price')
    	// return this->belongsToMany('Topic', 'forum_topic', 'forum_id', 'topic_id');
    }

    public static function show($slug, $forum_id)
    {
        return Forum::where([['slug', $slug], ['forum_id', $forum_id]])->firstOrFail();
    }

}
