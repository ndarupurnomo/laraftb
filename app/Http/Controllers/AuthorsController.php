<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Author;
use \Config as Config;
use App\Helpers\BBHelper;


use Session;

class AuthorsController extends Controller
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
        $authors = Author::orderBy('last_name')->orderBy('first_name')->with('topics')->paginate(30);
        $count = Author::count();
        // Session::flash('previous_route', 'authors.index');
        return view('forms.authors.index', compact('authors', 'count'));

        // $authors2c = array();
        // $authors2ci = array();
        // $counter = 0;
        // foreach ($authors as $row) {
        //     $authors2ci[] = $row;
        //     $counter++;
        //     if (($counter % 2) == 0) {
        //         $authors2c[] = $authors2ci;
        //         $authors2ci = array();
        //     }
        // }
        // return view('forms.authors.index')->with('authors', $authors2c);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorRequest $request)
    {
        // $this->validate($request, [
        //     'first_name' => 'required',
        //     'last_name' => 'required'
        // ]);

        // $fileName = '';
        $input = $request->all();
        $input['slug'] = str_slug($input['first_name'] . ' ' . $input['last_name']);

        //if user uploaded a photo
        if ($request->hasFile('user_file')) {
            $input['photo'] = BBHelper::uploadFile($request, 'user_file');
        }

        // if ($request->hasFile('user_file')) {
        //     if ($request->file('user_file')->isValid()) {
        //         $fileName = rand(11111,99999) . '_' . $request->file('user_file')->getClientOriginalName();
        //         $request->file('user_file')->move(Config::get('constants.image_path'), $fileName);
        //         $input['photo'] = $fileName;
        //     }
        //     else {
        //         Session::flash('error', 'uploaded file is not valid');
        //         return redirect()->back();
        //     }
        // }

        // Author::create([
        //     'first_name' => $request->input('first_name'), 
        //     'last_name' => $request->input('last_name'),
        //     'photo' => $fileName,
        //     'description' => $request->input('description'),
        //     'homepage_url' => $request->input('homepage_url')
        // ]);

        Author::create($input);
        Session::flash('flash_message', 'Author successfully added!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $author_id)
    {
        // $author = Author::findOrFail($slug);
        $author = Author::show($slug, $author_id);
        return view('forms.authors.show')->with('author', $author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($author_id)
    {
        $author = Author::findOrFail($author_id);
        return view('forms.authors.edit')->with('author', $author);
        // return view('authors.edit', ['author' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorRequest $request, $author_id)
    {
        $author = Author::findOrFail($author_id);

        // $this->validate($request, [
        //     'first_name' => 'required',
        //     'last_name' => 'required'
        // ]);

        // $fileName = '';
        $input = $request->all();
        // un-comment the line below to update the slug
        // $input['slug'] = str_slug($input['first_name'].' '.$input['last_name']);

        //if user uploaded a new photo
        if ($request->hasFile('user_file')) {
            $input['photo'] = BBHelper::uploadFile($request, 'user_file');
        }

        // if ($request->hasFile('user_file')) {
        //     if ($request->file('user_file')->isValid()) {
        //         $fileName = rand(11111,99999) . '_' . $request->file('user_file')->getClientOriginalName();
        //         $request->file('user_file')->move(Config::get('constants.image_path'), $fileName);
        //         $input['photo'] = $fileName;
        //     }
        //     else {
        //         Session::flash('error', 'uploaded file is not valid');
        //         return redirect()->back();
        //     }
        // }

        // dd($input);
        $author->fill($input)->save();
        Session::flash('flash_message', 'Author successfully updated!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($author_id)
    {
        $author = Author::findOrFail($author_id);
        $author->delete();

        Session::flash('flash_message', 'Author successfully deleted!');

        // if (Session::has('previous_route')) {
        //     if (Session::get('previous_route') == 'authors.index') {
        //         return redirect()->url()->previous();
        //     } 
        // }

        return redirect()->route('authors.index');
    }
}
