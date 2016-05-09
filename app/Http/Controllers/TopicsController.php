<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TopicRequest;
use App\Http\Controllers\Controller;
use App\Helpers\BBHelper;
use App\Topic;
use App\Category;
use App\Author;
use App\License;
use App\Publisher;
use App\Search;
use Session;
use \Config as Config;
use \Carbon\Carbon;
use BBCode;
use Purifier;
use GoogleSearch;


class TopicsController extends Controller
{
    // 
    public function __construct() {
        $this->middleware('admin', ['except' => ['index','show','search','google']]);
    }

    //
    public function search(Request $request)
    {
        $query = Purifier::clean($request->input('query'));
        $topics = Topic::published()->available()->where('topic_title', 'LIKE', '%' . $query . '%')->orderBy('topic_published_at','desc');
        $count = $topics->count();
        Search::store($query, $count);
        return view('forms.topics.search', compact('topics', 'query', 'count'));
    }

    public function google(Request $request)
    {
        $query = Purifier::clean($request->input('q'));
        // $topics = Topic::published()->available()->where('topic_title', 'LIKE', '%' . $query . '%')->orderBy('topic_published_at','desc');
        // $count = $topics->count();
        Search::store($query, 0);
        return view('pages.search', compact('query'));
    }

    public function tweet()
    {
        // $topics = Topic::
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::published()->available()->orderBy('topic_published_at','desc')->paginate(15);
        $count = Topic::published()->available()->count();
        return view('forms.topics.index', compact('topics', 'count'));
    }

    // protected function prepare($module) {
    //     $categories = Category::with('forums')->get();
    //     $forums = array();
    //     foreach ($categories as $category) {
    //         $forums[$category->cat_title] = $category->forums()->lists('forum_name','forum_id')->toArray();
    //     }
    //     $authors = array_pluck(Author::all()->sortBy('full_name_comma'), 'full_name_comma','author_id');
    //     $licenses = License::orderBy('license_name')->lists('license_name', 'license_id');
    //     $publishers = Publisher::orderBy('publisher_name')->lists('publisher_name', 'publisher_id');

    //     switch ($module) {
    //         case "edit":
    //             $topic = Topic::findOrFail($id);
    //             return view('forms.topics.edit', compact('topic', 'licenses', 'publishers', 'forums', 'authors'));
    //         case "create":
    //             return view('forms.topics.create', compact('licenses', 'publishers', 'forums', 'authors'));
    //         case "createUnder":
    //             return view('forms.topics.create', compact('licenses', 'publishers', 'forums', 'authors'));
    //         default:
    //             return abort(404);
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // // prepares categories-forums array for grouped select
        // $categories = Category::with('forums')->get();
        // $forums = array();
        // foreach ($categories as $category) {
        //     $forums[$category->cat_title] = $category->forums()->lists('forum_name','forum_id')->toArray();
        // }
        // $authors = array_pluck(Author::all()->sortBy('full_name_comma'), 'full_name_comma','author_id');
        // $licenses = License::orderBy('license_name')->lists('license_name', 'license_id');
        // $publishers = Publisher::orderBy('publisher_name')->lists('publisher_name', 'publisher_id');

        // $topic = Topic::findOrFail($id);

        return view('forms.topics.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function createUnder($forum_id)
    // {
    //     // 
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request)
    {
        $input = $request->all();
        $input['slug'] = str_slug($input['topic_title']);
        $input['topic_post_edit_count'] = 1;
        $input['topic_tweeted'] = 0;

        if ($request->hasFile('user_file')) {
            $input['topic_cover'] = BBHelper::uploadFile($request, 'user_file');
        }

        $topic = Topic::create($input);

        $topic->forums()->attach($request->input('forum_list', []));
        $topic->authors()->attach($request->input('author_list', []));

        Session::flash('flash_message', 'Book successfully added!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // // prepares categories-forums array for grouped select
        // $categories = Category::with('forums')->get();
        // $forums = array();
        // foreach ($categories as $category) {
        //     $forums[$category->cat_title] = $category->forums()->lists('forum_name','forum_id')->toArray();
        // }
        // $authors = array_pluck(Author::all()->sortBy('full_name_comma'), 'full_name_comma','author_id');
        // $licenses = License::orderBy('license_name')->lists('license_name', 'license_id');
        // $publishers = Publisher::orderBy('publisher_name')->lists('publisher_name', 'publisher_id');

        $topic = Topic::findOrFail($id);

        return view('forms.topics.edit', compact('topic'));
        // return view('forms.topics.edit', compact('topic', 'licenses', 'publishers', 'forums', 'authors'));

        // $this->prepare('edit');

        // return view('forms.topics.edit')
        //     ->with('topic', $topic)
        //     ->with('licenses', $licenses)
        //     ->with('publishers', $publishers)
        //     ->with('forums', $forums)
        //     ->with('authors', $authors);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $input = $request->all();

        // un-comment the line below to update the slug
        // $input['slug'] = str_slug($input['topic_title']);

        //if user uploaded a new cover
        if ($request->hasFile('user_file')) {
            $topic->topic_cover = BBHelper::uploadFile($request, 'user_file');
        }
        // dd($input);
        // if (! $input['license_id']) {
        //     $topic->license_id = null;
        // }


        // dd($input);
        $topic->fill($input);
        // dd($topic);
        // when user clears select2 control, the underlying variabe won't be included inside the request, so we need to assert the variable
        $topic->license_id = $request->input('license_id', null);
        // same here
        $topic->publisher_id = $request->input('publisher_id', null);

        $topic->topic_post_edit_count++;
        $topic->save();

        $topic->forums()->sync($request->input('forum_list', []));
        $topic->authors()->sync($request->input('author_list', []));

        Session::flash('flash_message', 'Book successfully updated!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        Session::flash('flash_message', 'Book successfully deleted!');

        return redirect()->route('categories.index');
    }
}
