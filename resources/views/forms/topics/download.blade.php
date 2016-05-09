@extends('layouts.master')

@section('page-title')
	<title>Download Books List</title>
	<meta name="description" lang="en" content="Download Book List">
@stop

@section('content')

<p class="h1">Download Books List</p>
<p class="lead">All books links in a single Excel document</p>
<hr>

<div class="row">
	<!-- content column -->
	<div class="col-lg-8 col-md-8">

		<span class="visible-xs visible-sm">
			@include('partials.social')
		</span>

		{{--
		  @include('partials.topics.list', array('topics' => $topics))
		--}}
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

