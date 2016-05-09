<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Category;
use App\Forum;
use App\Topic;
use App\Author;
use App\License;
use App\Publisher;
// use Feed;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.nav', function($view) {
            // eager-load categories and forums
            $categories = Category::orderBy('cat_order','asc')->with('forums')->get();
            // params: url, format (or custom type), title (optional), language (optional)
            // $rss = Feed::link(url('rss'), 'atom', 'FreeTechBooks', 'en');
            $view->with('categories', $categories); // ->with('rss', $rss);
        });

        view()->composer('partials.categories.list', function($view) {
            // eager-load categories and forums
            $categories = Category::orderBy('cat_order','asc')->with('forums')->get();
            $view->with('categories', $categories);
        });

        view()->composer('partials.topics.popular', function($view) {
            // get most popular books
            $populars = Topic::published()
                ->available()
                ->select('topics.topic_id', 'topic_title', 'topic_time', 'topic_views', 'topic_description', 'slug')
                ->orderBy('topic_views','desc')->take(10)->get();
            $view->with('populars', $populars);
        });    

        view()->composer('partials.topics.edit', function($view) {
            // prepare categories-forums array for grouped select
            $categories = Category::with('forums')->get();
            $forums = array();
            foreach ($categories as $category) {
                $forums[$category->cat_title] = $category->forums()->lists('forum_name','forum_id')->toArray();
            }
            // prepare author select list
            $authors = array_pluck(Author::all()->sortBy('full_name_comma'), 'full_name_comma','author_id');
            // prepare license select list
            $licenses = License::orderBy('license_name')->lists('license_name', 'license_id');
            // prepare publisher select list
            $publishers = Publisher::orderBy('publisher_name')->lists('publisher_name', 'publisher_id');
            $view
                ->with('forums', $forums)
                ->with('authors', $authors)
                ->with('licenses', $licenses)
                ->with('publishers', $publishers);
        });    

        view()->composer('partials.forums.edit', function($view) {
            // prepare categories select list
            $categories = Category::orderBy('cat_title')->lists('cat_title', 'cat_id');
            $view->with('categories', $categories);
        });    

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
