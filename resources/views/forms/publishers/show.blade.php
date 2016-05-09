@extends('layouts.master')

@section('page-title')
	<title>{{ $publisher->publisher_name }}</title>
	<meta name="description" lang="en" content="More information about {{ $publisher->publisher_name }} and books published by it.">
@stop

@section('content')

	<p class="h2">{{ $publisher->publisher_name }}</p>
	
	<a href="{{ route('publishers.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> All publishers</a>
	@if($publisher->publisher_url)
		<a href="{{ $publisher->publisher_url }}" target="_blank" class="btn btn-primary"><i class="fa fa-home fa-lg"></i> Website</a>
	@endif
    @if (Auth::check() && Auth::user()->isAdmin())
	    <a href="{{ route('publishers.edit', $publisher->publisher_id) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
		<div class="pull-right">
	        {!! Form::open([
	            'method' => 'DELETE',
	            'route' => ['publishers.destroy', $publisher->publisher_id]
	        ]) !!}
	        <!-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} -->
	        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete publisher '{{ $publisher->publisher_name }}'" data-message="Are you sure?"><i class="fa fa-trash-o"></i> Delete</button>
	        {!! Form::close() !!}
		</div>
    @endif

	<hr>


	<div class="row">
		<!-- content column -->
		<div class="col-lg-8 col-md-8">
			<span class="visible-xs visible-sm">
				@include('partials.social')
			</span>

			<p class="lead">Books published by {{ $publisher->publisher_name }}</p>

			<!-- Recent Books -->
			@include('partials.topics.list', array('topics' => $publisher->topics()->published()->available()->orderBy('topic_published_at','desc')->paginate(15)))
		</div>

		<!-- side navigation column -->
		<div class="col-lg-4 col-md-4">
			<span class="visible-md visible-lg">
				@include('partials.social')
			</span>

			@include('partials.categories.list')
			@include('partials.ads.tribalfusion300x250')
		</div>

	</div>



@stop