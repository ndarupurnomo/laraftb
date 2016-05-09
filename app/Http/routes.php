<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('phpinfo', function () {
    return phpinfo();
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::auth();

	Route::get('home', 'HomeController@index');

	Route::get('/', [
		'as' => 'front',
		'uses' => 'PagesController@front'
	]);

	Route::get('contact', [
		'as' => 'contact', 
		'uses' => 'AboutController@create'
	]);
	Route::post('contact', [
		'as' => 'contact_store', 
		'uses' => 'AboutController@store'
	]);
	// Route::get('about', [
	// 	'as' => 'about', 
	// 	'uses' => 'AboutController@about'
	// ]);

	Route::get('about', ['as' => 'about', function() {
		$post = App\Post::type('page')->slug('about-freetechbooks')->first();
		return view('forms.posts.show')->with('post', $post)->with('excerpt', 'no')->with('type', 'page');
	}]);

	Route::resource('publishers', 'PublishersController', ['except' => ['show']]);

	Route::resource('licenses', 'LicensesController', ['except' => ['show']]);

	Route::resource('categories', 'CategoriesController', ['except' => ['show']]);

	Route::resource('forums', 'ForumsController', ['except' => ['show', 'index']]);

	Route::resource('topics', 'TopicsController', ['except' => ['show']]);

	Route::get('topics/search', [
		'as' => 'topics.search', 
		'uses' => 'TopicsController@search'
	]);

	Route::get('search', ['as' => 'topics.google', function() {
		return view('pages.search');
	}]);

	Route::get('topics/download', ['as' => 'topics.download', function() {
		// $topics = App\Topic::select('topics.topic_id', 'topic_title', 'topic_time', 'topic_description', 'topic_download_url', 'created_at', 'slug')
		// 		 	->orderBy('created_at','desc')->paginate(300);
		// return view('forms.topics.checklinks')->with('topics', $topics);
		return view('forms.topics.download');
	}]);

	Route::get('topics/checklinks', ['as' => 'topics.checklinks', function() {
		$topics = App\Topic::select('topics.topic_id', 'topic_title', 'topic_time', 'topic_description', 'topic_download_url', 'created_at', 'slug')
				 	->orderBy('created_at','desc')->paginate(300);
		return view('forms.topics.checklinks')->with('topics', $topics);
	}]);

	Route::get('authors/checklinks', ['as' => 'authors.checklinks', function() {
		$authors = App\Author::select('authors.author_id', 'first_name', 'last_name', 'homepage_url', 'created_at', 'slug')
				 	->orderBy('last_name','asc')->orderBy('first_name','asc')->paginate(300);
		return view('forms.authors.checklinks')->with('authors', $authors);
	}]);

	// Route::get('twitter/test', ['as' => 'twitter.test', function()
	// {
	// 	$uploaded_media = Twitter::uploadMedia(['media' => File::get(public_path('/img/logo_left.gif'))]);
	// 	$tweet = Twitter::postTweet([
	// 			'status' => 'Laravel is beautiful', 
	// 			'media_ids' => $uploaded_media->media_id_string, 
	// 			'format' => 'json'
	// 	]);
	// 	return;
	// }]);

	// Route::get('twitter/testlink', ['as' => 'twitter.test', function()
	// {
	// 	$uploaded_media = Twitter::uploadMedia(['media' => File::get(public_path('/img/logo_left.gif'))]);
	// 	$tweet = Twitter::postTweet([
	// 			'status' => 'Ada Distilled for Ada 2005: An Introduction to Ada Programming for Experience Computer Pr... http://www.freetechbooks.com/ada-distilled-for-ada-2005-an-introduction-to-ada-programming-for-experienced-computer-programmers-t908.html', 
	// 			'media_ids' => $uploaded_media->media_id_string, 
	// 			'format' => 'json'
	// 	]);
	// 	return;
	// }]);

	// Route::get('getting-started', ['as' => 'getting.started', function() {
	// 	return view('pages.comingsoon');
	// }]);

	Route::resource('authors', 'AuthorsController', ['except' => ['show']]);

	Route::resource('posts', 'PostsController', ['only' => ['index', 'show']]);

	// Route::get('authors/json', ['as' => 'authors.json', function() {
	// 	$authors = array_pluck(\App\Author::all()->sortBy('full_name_comma'), 'full_name_comma','author_id');
	// 	return json_encode($authors);
	// }]);

  	// Route::resource('books', 'BooksController', ['except' => ['show']]);


	// // Add the new route
	// Route::get('rss', 'BlogController@rss');

	Route::get('rss', ['as' => 'rss', function(){
	    // create new feed
	    $feed = App::make("feed");

	    // multiple feeds are supported
	    // if you are using caching you should set different cache keys for your feeds

	    // cache the feed for 60 minutes (second parameter is optional)
	    $feed->setCache(60, 'laravelFeedKey');

	    // check if there is cached feed and build new only if is not
	    if (!$feed->isCached())
	    {
			// creating rss feed with our most recent 20 posts
			$posts = App\Topic::published()
				->available()
				->select('topics.topic_id', 'topic_title', 'topic_time', 'topic_description', 'topic_published_at', 'slug')
				->orderBy('topic_published_at','desc')->take(20)->get();

			// set your feed's title, description, link, pubdate and language
			$feed->title = 'FreeTechBooks';
			$feed->description = 'Free Online Computer Science and Programming Books, Textbooks, and Lecture Notes';
			$feed->logo = 'http://www.freetechbooks.com/img/logo_left.gif';
			$feed->link = url('rss');
			$feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
			$feed->pubdate = $posts[0]->topic_published_at;
			$feed->lang = 'en';
			$feed->setShortening(true); // true or false
			$feed->setTextLimit(255); // maximum length of description text

			foreach ($posts as $post)
			{
			   // set item's title, author, url, pubdate, description, content, enclosure (optional)*
 			   // $feed->add($post->topic_title, route('slug', ['slug' => $post->slug . '-t' . $post->topic_id . '.html']), $post->topic_description, $post->created_at);
	           $feed->add(htmlspecialchars($post->topic_title, ENT_QUOTES), 'Ndaru', url(route('slug', ['slug' => $post->slug . '-t' . $post->topic_id . '.html'])), $post->topic_published_at, htmlspecialchars($post->topic_description, ENT_QUOTES), htmlspecialchars($post->topic_description, ENT_QUOTES));
			}

	    }

		$feed->ctype = "text/xml";

	    // first param is the feed format
	    // optional: second param is cache duration (value of 0 turns off caching)
	    // optional: you can set custom cache key with 3rd param as string
	    return $feed->render('rss');

	    // to return your feed as a string set second param to -1
	    // $xml = $feed->render('atom', -1);

	}]);

	Route::get('cache/flush', ['as' => 'cache.flush', function(){
		Cache::flush();
		return 'Flushed!';
	}]);

	Route::get('geoip', ['as' => 'geoip', function(){
		$location = GeoIP::getLocation();
		dd($location);
	}]);

	Route::get('sitemap.xml', ['as' => 'sitemap', function(){

	    // create new sitemap object
	    $sitemap = App::make("sitemap");

	    // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
	    // by default cache is disabled
	    // $sitemap->setCache('laravel.sitemap', 60);

	    // check if there is cached sitemap and build new only if is not
	    // if (!$sitemap->isCached())
	    // {
			// add item to the sitemap (url, date, priority, freq)
			$sitemap->add(route('front'), '2016-04-01T20:10:00+02:00', '1.0', 'hourly');
			$sitemap->add(route('about'), '2016-04-01T12:30:00+02:00', '0.5', 'daily');
			$sitemap->add(route('categories.index'), '2016-04-01T12:30:00+02:00', '0.5', 'daily');
			$sitemap->add(route('authors.index'), '2016-04-01T12:30:00+02:00', '0.5', 'daily');
			$sitemap->add(route('publishers.index'), '2016-04-01T12:30:00+02:00', '0.5', 'daily');
			$sitemap->add(route('licenses.index'), '2016-04-01T12:30:00+02:00', '0.5', 'daily');

			$chunk_size = 40;
			// all forums
			App\Forum::select('forums.forum_id', 'slug', 'created_at')->chunk($chunk_size, function ($forums) use ($sitemap) {
				foreach ($forums as $forum) {
					$sitemap->add(route('slug', ['slug' => $forum->slug . '-f' . $forum->forum_id . '.html']), $forum->created_at, '0.8', 'daily');
				}
			});

			// all topics
			App\Topic::select('topics.topic_id', 'slug', 'created_at')->chunk($chunk_size, function ($topics) use ($sitemap) {
				foreach ($topics as $topic) {
					$sitemap->add(route('slug', ['slug' => $topic->slug . '-t' . $topic->topic_id . '.html']), $topic->created_at, '0.8', 'daily');
				}
			});

			// all authors
			App\Author::select('authors.author_id', 'slug', 'created_at')->chunk($chunk_size, function ($authors) use ($sitemap) {
				foreach ($authors as $author) {
					$sitemap->add(route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']), $author->created_at, '0.5', 'daily');
				}
			});

			// all publishers
			App\Publisher::select('publishers.publisher_id', 'slug', 'created_at')->chunk($chunk_size, function ($publishers) use ($sitemap) {
				foreach ($publishers as $publisher) {
					$sitemap->add(route('slug', ['slug' => $publisher->slug . '-p' . $publisher->publisher_id . '.html']), $publisher->created_at, '0.5', 'weekly');
				}
			});

			// all licenses
			App\License::select('licenses.license_id', 'slug', 'created_at')->chunk($chunk_size, function ($licenses) use ($sitemap) {
				foreach ($licenses as $license) {
					$sitemap->add(route('slug', ['slug' => $license->slug . '-l' . $license->license_id . '.html']), $license->created_at, '0.5', 'weekly');
				}
			});
	    // }

	    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
	    return $sitemap->render('xml');

	}]);

	Route::get('/{slug}', ['as' => 'slug', function($slug) {
		//parse the slug url
		$bare_slug = substr($slug,0,strrpos($slug, '-'));
		$module = substr(strrchr($slug, '-'), 1, 1);
		$id = substr($slug, strrpos($slug, '-') + 2);
		//slugged routes
		switch ($module) {
		    case "a":
				$author = App\Author::show($bare_slug, $id);
		        return view('forms.authors.show')->with('author', $author);
		    case "p":
				$publisher = App\Publisher::show($bare_slug, $id);
		        return view('forms.publishers.show')->with('publisher', $publisher);
		    case "l":
				$license = App\License::show($bare_slug, $id);
		        return view('forms.licenses.show')->with('license', $license);
		  //   case "b":
				// $book = App\Book::show($bare_slug, $id);
		  //       return view('books.show')->with('book', $book);
		    case "f":
				$forum = App\Forum::show($bare_slug, $id);
				// $topics = $forum->topics()->published()->get();
				// $topics = $forum->topics()->published()->orderBy('topic_title','asc')->paginate(15);
		        return view('forms.forums.show')->with('forum', $forum);
		        // return view('forums.show')->with('forum', $forum)->with('topics', $topics);
		    case "t":
				$topic = App\Topic::show($bare_slug, $id);
		        if (($topic->topic_published_status == 'Published') || (Auth::check() && Auth::user()->isAdmin())) {
		            return view('forms.topics.show')->with('topic', $topic);
		        }
		    case "b":
				$post = App\Post::show($bare_slug, $id);
		        if (($post->status == 'publish') || (Auth::check() && Auth::user()->isAdmin())) {
		            return view('forms.posts.show')->with('post', $post)->with('excerpt', 'no')->with('type','post');
		        }
		    default:
				return abort(404);
		}

	}]);

});
