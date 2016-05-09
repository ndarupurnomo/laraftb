<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
// use App\Scopes\CategoryScope;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'cat_id';

    public function forums() {
    	return $this->hasMany('App\Forum', 'cat_id', 'cat_id')->orderBy('forum_order'); // $this->hasMany('Model', 'foreign_key', 'local_key');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('cat_id', function(Builder $builder) {
            $builder->whereNotIn('cat_id', [7,8,9,10]);
        });        
    }

    public function getCatTitleLessAttribute() {
        return str_replace(" Books", "", $this->cat_title);;
    }

}
