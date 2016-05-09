@extends('layouts.master')

@section('page-title')
	<title>Search Result for Book Title '{{ $query }}'</title>
	<meta name="description" lang="en" content="Search result for book title '{{ $query }}'">
@stop

@section('content')

<h1>Search result for '{{ $query }}'</h1>
<p class="lead">Your search query matches {{ $count }} books.</p>
<hr>

<div class="row">
	<!-- content column -->
	<div class="col-lg-8 col-md-8">

		@include('partials.topics.list', array('topics' => $topics->paginate(15), 'module' => 'search'))

		@include('partials.ads.tribalfusion728x90')

	</div>

	<!-- side navigation column -->
	<div class="col-lg-4 col-md-4">
		@include('partials.social')
		@include('partials.categories.list')
		@include('partials.topics.popular')
		@include('partials.ads.tribalfusion300x250')
	</div>

</div>

@stop

@section('extra-footer')

@stop

