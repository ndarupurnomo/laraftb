@extends('layouts.master')

@section('page-title')
	<title>List of all notes</title>
	<meta name="description" lang="en" content="List of all notes">
@stop

@section('content')

<p class="h1">List of all Notes</p>
<p class="lead">So far we have a total of {{ $count }} notes</p>
<hr>

<div class="row">
	<!-- content column -->
	<div class="col-lg-8 col-md-8">

		<span class="visible-xs visible-sm">
			@include('partials.social')
		</span>

		@include('partials.posts.list', array('posts' => $posts, 'excerpt' => 'yes'))
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

@stop

@section('extra-footer')

@stop

