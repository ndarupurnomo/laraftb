<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PublisherRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Publisher;

use Session;

class PublishersController extends Controller
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
        $publishers = Publisher::orderBy('publisher_name')->paginate(20);
        $count = Publisher::count();
        return view('forms.publishers.index', compact('publishers', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublisherRequest $request)
    {
        $input = $request->all();
        $input['slug'] = str_slug($input['publisher_name']);
        Publisher::create($input);
        Session::flash('flash_message', 'Publisher successfully updated!');
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
    public function edit($publisher_id)
    {
        $publisher = Publisher::findOrFail($publisher_id);
        return view('forms.publishers.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $publisher_id)
    {
        $publisher = Publisher::findOrFail($publisher_id);
        $input = $request->all();
        // un-comment the line below to update the slug
        // $input['slug'] = str_slug($input['publisher_name']);

        $publisher->fill($input)->save();
        Session::flash('flash_message', 'Publisher successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($publisher_id)
    {
        $publisher = Publisher::findOrFail($publisher_id);
        $publisher->delete();
        Session::flash('flash_message', 'Publisher successfully deleted!');
        return redirect()->route('publishers.index');
    }
}
