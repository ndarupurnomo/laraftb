<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ForumRequest;
use App\Http\Controllers\Controller;

use App\Forum;
use Session;

class ForumsController extends Controller
{
    // 
    public function __construct() {
        $this->middleware('admin', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.forums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumRequest $request)
    {
        $input = $request->all();
        $input['slug'] = str_slug($input['forum_name']);
        $input['forum_sort'] = 'ASC';
        $forum = Forum::create($input);
        Session::flash('flash_message', 'Sub-Category successfully created!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $forum = Forum::findOrFail($id);
        return view('forms.forums.edit', compact('forum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ForumRequest $request, $id)
    {
        $forum = Forum::findOrFail($id);
        $input = $request->all();

        // un-comment the line below to update the slug
        // $input['slug'] = str_slug($input['forum_name']);

        $forum->fill($input);
        // when user clears select2 control, the underlying variabe won't be included inside the request, so we need to assert the variable
        $forum->cat_id = $request->input('cat_id', null);
        $forum->save();
        Session::flash('flash_message', 'Sub-category successfully updated!');

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
        $forum = Forum::findOrFail($id);
        $forum->delete();
        Session::flash('flash_message', 'Sub-category successfully deleted!');

        return redirect()->route('categories.index');
    }
}
