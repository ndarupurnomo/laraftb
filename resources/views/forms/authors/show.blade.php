@extends('layouts.master')

@section('page-title')
	<title>{{ $author->full_name }}</title>
	<meta name="description" lang="en" content="More information about {{ $author->full_name }} and his/her books listed in FreeTechBooks.">
@stop

@section('content')
	
	<div class="row">
		<!-- content column -->
		<div class="col-lg-8 col-md-8">

			@include('partials.authors.snippedbig')

		    @if (Auth::check() && Auth::user()->isAdmin())
				<a href="{{ route('authors.edit', $author->author_id) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
				<div class="pull-right">
			        {!! Form::open([
			            'method' => 'DELETE',
			            'route' => ['authors.destroy', $author->author_id]
			        ]) !!}
			        <!-- {!! Form::submit('Delete this author?', ['class' => 'btn btn-danger']) !!} -->
			        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete author '{{ $author->full_name }}'" data-message="Are you sure?"><i class="fa fa-trash-o"></i> Delete</button>
			        {!! Form::close() !!}
				</div>
		    @endif

			<hr>

			<span class="visible-xs visible-sm">
				@include('partials.social')
			</span>

			<p class="lead">Books by {{ $author->full_name }}</p>
			<!-- Recent Books -->
			@include('partials.topics.list', array('topics' => $author->topics()->published()->available()->orderBy('topic_published_at','desc')->paginate(15)))
			@include('partials.ads.tribalfusion728x90')

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

@section('extra-footer')

@include('partials.alerts.confirmdelete')

@stop
