<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ContactFormRequest;
use App\Post;

use Session;
use Mail;
use Purifier;

class AboutController extends Controller
{
	public function about() {
        // $post = Post::type('page')->slug('about-freetechbooks')->first();
        // $post = \App\Post::where([['post_type', 'page'], ['post_name', 'about']])->firstOrFail();
        // $post = Post::orderBy('post_date','desc')->published()->type('page')->take(1)->get();
        // dd($post);
        // return view('forms.posts.show')->with('post', $post)->with('excerpt', 'no');
		return view('pages.about');	
	}

    public function create()
    {
        return view('forms.about.contact');
    }

	public function store(ContactFormRequest $request)
	{
		$data = $request->all();

		foreach ($data as &$value) {
		    $value = Purifier::clean($value);
		}

		Mail::send(['text' => 'forms.emails.contact'], $data,
	    // [
	    //     'name' => $request->get('name'),
	    //     'email' => $request->get('email'),
	    //     'user_message' => $request->get('user_message')
	    // ], 
	    function($message) use ($data) {
		    $message->from('noreply@freetechbooks.com', 'FreeTechBooks');
		    $message->replyTo($data['email'] , $data['name']);
		    // $message->replyTo($request->get('email'), $request->get('name'));
		    $message->to('ndaru.purnomo@gmail.com', 'Ndaru')->subject('FreeTechBooks Feedback');
		});

		// return \Redirect::route('contact')->with('message', 'Thanks for contacting us!');

		Session::flash('flash_message', 'Thanks for contacting us!');
		return redirect()->back();
		// return \Redirect::route('contact')->with('message', 'Thanks for contacting us!');
	}
}
