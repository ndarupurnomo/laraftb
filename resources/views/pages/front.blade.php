@extends('layouts.master')

@section('page-title')
	<title>Database of Free Online Computer Science and Programming Books, Textbooks, and Lecture Notes</title>
	<meta name="description" lang="en" content="This site lists free online computer science, engineering and programming books, textbooks and lecture notes, all of which are legally and freely available.">
	<meta property="og:url"            content="{{ url()->current() }}" />
	<meta property="og:type"           content="frontpage" />
	<meta property="og:title"          content="Free Online Computer Science and Programming Books, Textbooks, and Lecture Notes" />
	<meta property="og:description"    content="This site lists free online computer science, engineering and programming books, textbooks and lecture notes, all of which are legally and freely available." />
	<meta property="og:image"          content="{{ Request::root() . '/' . Config::get('constants.image_path') . '/' . 'logo_left.gif' }}" />
	<meta name="google-site-verification" content="cphkcR_kP71kZTwhPDdW1OzPGX4i229uRrSmSjmZ92s" />
@stop

@section('extra-header')
<style type="text/css">
	.navbar {
		margin-bottom: 0px;
	}
</style>
@stop

@section('pre-content')
<div class="jumbotron">
	<div class="container">
		<p class="h1"><strong>Welcome to FreeTechBooks!</strong></p>
		<p>Database of Free Online Computer Science and Programming Books, Textbooks, and Lecture Notes<br>
		({{ App\Topic::published()->available()->count() }} books and growing)</p>
        <ul class="list-inline">
        	<li><a class="btn btn-primary" href="{{ route('about') }}" role="button">About <i class="fa fa-chevron-circle-right"></i></a></li>
        	<li><a class="btn btn-primary" href="{{ route('contact') }}" role="button">Contact <i class="fa fa-envelope"></i></a></li>
        </ul>
	</div>
</div>
@stop

@section('content')
	<div class="row">
		<!-- content column -->
		<div class="col-lg-8 col-md-8">

			{{-- @include('partials.topics.search') --}}

			{{-- @include('partials.google.cse') --}}

			<span class="visible-xs visible-sm">
				@include('partials.social')
			</span>


			<p class="h1"><strong>Recently Added Books</strong></p>
			<hr>
			<!-- Recent Books -->
			@include('partials.topics.list', array('topics' => App\Topic::published()->available()->orderBy('topic_published_at','desc')->take(20)->get()))

		    <p><a href="{{ route('topics.index') }}" class="btn btn-primary pull-right">See all posted books <i class="fa fa-arrow-circle-right"></i></a></p>
		    <br/><br/><br/>

			<p class="h1"><strong>Recently Posted Notes</strong></p>
			<hr>

			<!-- Recent Books -->
			@include('partials.posts.list', array('posts' => App\Post::orderBy('post_date','desc')->published()->type('post')->take(1)->get(), 'excerpt' => 'no'))

		    <p><a href="{{ route('posts.index') }}" class="btn btn-primary pull-right">See all notes <i class="fa fa-arrow-circle-right"></i></a></p>
		    <br/><br/><br/>

			@include('partials.ads.tribalfusion728x90')

		</div>

		<!-- side navigation column -->
		<div class="col-lg-4 col-md-4">

			<span class="visible-md visible-lg">
				@include('partials.social')
			</span>

			@include('partials.categories.list')

           
			@include('partials.ads.textlinkads')

			@include('partials.topics.popular')

			@include('partials.ads.tribalfusion300x250')

		</div>
	</div>
@stop

@section('extra-footer')
@stop