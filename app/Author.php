<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\BBHelper;
use Decoda\Decoda;
// use Purifier;

class Author extends Model
{
    protected $primaryKey = 'author_id';

     /**
     * Fillable fields
     * 
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'photo',
        'description',
        'homepage_url',
        'slug'
    ];

    // public function setDescriptionAttribute($value) {
    //     $this->attributes['description'] = Purifier::clean($value);
    // }

    public static function show($slug, $author_id)
    {
        // return Author::where('slug', $slug)->where('author_id', $author_id)->firstOrFail();
        return Author::where([['slug', $slug], ['author_id', $author_id]])->firstOrFail();
    }

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFullNameCommaAttribute() {
        return $this->last_name . ', ' . $this->first_name;
    }

    public function topics() {
        return $this->belongsToMany('App\Topic')->published()->available()->withTimestamps();
        // return $this->belongsToMany('App\Topic', 'author_topic', 'author_id', 'topic_id')->withTimestamps();
    }

    public function getDescriptionHtmlAttribute() {
        // return BBCode::parse($this->description);
        if ($this->description) {
            // $code = new Decoda($this->description);
            // $code->defaults();
            // // Or load filters and hooks
            // return $code->parse();       
            // return BBHelper::bb2html($this->description, '');
            return BBHelper::phpbb2html(trim($this->description));
        } else {
            return ('No information is available for this author.');
        }
    }

}
