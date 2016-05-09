@extends('layouts.master')

@section('page-title')
	<title>{{ $forum->forum_name }}</title>
	<meta name="description" lang="en" content="{{ $forum->forum_desc }}">
	<meta property="og:url"            content="{{ url()->current() }}" />
	<meta property="og:type"           content="category" />
	<meta property="og:title"          content="{{ $forum->forum_name }}" />
	<meta property="og:description"    content="{{ $forum->forum_desc }}" />
	<meta property="og:image"          content="{{ Request::root() . '/' . Config::get('constants.image_path') . '/' . 'logo_left.gif' }}" />
@stop

@section('content')

	<p class="h1">{{ $forum->forum_name }}</p>
	<p class="lead">{{ $forum->forum_desc }}</p>
 	<a href="{{ route('categories.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> All categories</a>

	<hr>
	
	<div class="row">

		<!-- content column -->
		<div class="col-lg-8 col-md-8">
			<span class="visible-xs visible-sm">
				@include('partials.social')
			</span>

			<p class="lead">Books under this sub-category ({{ $forum->topics()->published()->available()->count() }} books)</p>
			<!-- <hr> -->
			<!-- Recent Books -->
			@include('partials.topics.list', array('topics' => $forum->topics()->published()->available()->orderBy('topic_title','asc')->paginate(15)))
			@include('partials.ads.tribalfusion728x90')
		</div>

		<!-- side navigation column -->
		<div class="col-lg-4 col-md-4">
			<span class="visible-md visible-lg">
				@include('partials.social')
			</span>

			@include('partials.categories.list')
			@include('partials.topics.popular')
			@include('partials.ads.tribalfusion300x250')
		</div>
	</div>

<!-- <p class="lead">Books under this sub-category</p>
<p class="lead">Here's a list of all books under this sub-category.</p>
<hr>

@foreach($forum->topics()->published()->get() as $topic)
	<p><a href="{{ route('slug', ['slug' => $topic->slug . '-t' . $topic->topic_id . '.html']) }}">{{ $topic->topic_title }}</a></p>
	<p>{{ $topic->topic_description }}</p>
	<hr>
@endforeach
 -->

@stop

