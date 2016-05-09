@extends('layouts.master')

@section('page-title')
	<title>Search Result</title>
	<meta name="description" lang="en" content="Search result'">
@stop

@section('content')

<p class="lead">Search result</p>

<div class="row">
	<!-- content column -->
	<div class="col-lg-8 col-md-8">

		@include('partials.google.cse')

		{{-- @include('partials.google.result') --}}

		@include('partials.ads.tribalfusion728x90')

	</div>

	<!-- side navigation column -->
	<div class="col-lg-4 col-md-4">
		@include('partials.categories.list')
		@include('partials.topics.popular')
		@include('partials.ads.tribalfusion300x250')
	</div>

</div>

@stop

@section('extra-footer')

@stop

