<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('post_date','desc')->published()->type('post')->paginate(10);
        $count = Post::published()->type('post')->count();
        return view('forms.posts.index', compact('posts', 'count'));

        // $query = new \WP_Query(array(
        //     'post_type' => 'post',
        //     'post_status' => 'publish',
        //     'posts_per_page' => 10,
        //     'order' => 'DESC',
        //     'orderby' => 'post_date',
        // ));

        // $posts = $query->get_posts();
        // $count = count($posts);

        // return view('forms.posts.index', compact('posts', 'count'));

    }
}
