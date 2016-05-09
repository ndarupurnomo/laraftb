<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Topic;
use App\Category;

class PagesController extends Controller
{
    public function front() {
    	// get recent published books
    	// $topics = Topic::published()->orderBy('created_at','desc')->take(15)->get();
    	return view('pages.front');
    	// return view('pages.front', compact('topics'));
    }
}
