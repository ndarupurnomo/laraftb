<?php

namespace App;

use Corcel\Post as Corcel;

// use Illuminate\Database\Eloquent\Model;

class Post extends Corcel
{
    protected $connection = 'wordpress';

    public function getContentReadMoreAttribute() {
    	$content = $this->content;
    	// dd($content);
    	$content = strip_shortcodes($content);
    	$content = apply_filters('the_content', $content);
    	$content = nl2br($content);
		$content = str_replace(']]>', ']]&gt;', $content);
    	// $content = get_the_content('Read more');
		$content_arr = get_extended ($content);
    	$content = $content_arr['main'];
		return $content;
    }

    public function getContentFullAttribute() {
    	$content = $this->content;
    	// dd($content);
    	$content = strip_shortcodes($content);
    	$content = apply_filters('the_content', $content);
    	$content = nl2br($content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
    }

    public function getCreatedAtFormattedAttribute() {
        if ($this->created_at) {
            return $this->created_at->format('d M Y h:i:s');
        }
    }

    public static function show($slug, $id)
    {
        $post = Post::where([['post_name', $slug], ['ID', $id]])->firstOrFail();
        return $post;
    }

}
