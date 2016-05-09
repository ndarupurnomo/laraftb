<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book;
use \Config as Config;

use Session;

class BooksController extends Controller
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
        $books = Book::all();
        return view('forms.books.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'download_url' => 'required'
        ]);

        $fileName = '';

        if ($request->hasFile('user_file') && $request->file('user_file')->isValid()) {
            $fileName = rand(11111,99999) . $request->file('user_file')->getClientOriginalName();
            $request->file('user_file')->move(Config::get('constants.image_path'), $fileName);
        }
        else {
            Session::flash('error', 'uploaded file is not valid');
            return redirect()->back();
        }        

        $input = $request->all();
        $input['cover'] = $fileName;
        Book::create($input);
        Session::flash('flash_message', 'Book successfully added!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // $book = Book::findOrFail($id);
        // return view('books.show')->with('book', $book);
        return 'Hello Book!';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('forms.books.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $this->validate($request, [
            'title' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'download_url' => 'required'
        ]);

        $fileName = '';

        if ($request->hasFile('user_file') && $request->file('user_file')->isValid()) {
            $fileName = rand(11111,99999) . '_' . $request->file('user_file')->getClientOriginalName();
            $request->file('user_file')->move(Config::get('constants.image_path'), $fileName);
        }
        else {
            Session::flash('error', 'uploaded file is not valid');
            return redirect()->back();
        }        

        $input = $request->all();
        $input['cover'] = $fileName;
        $book->fill($input)->save();
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
        $book = Book::findOrFail($id);

        $book->delete();

        Session::flash('flash_message', 'Book successfully deleted!');

        return redirect()->route('books.index');
    }
}
