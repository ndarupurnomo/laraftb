@extends('layouts.master')

@section('page-title')
	<title>{{ $license->license_name }}</title>
	<meta name="description" lang="en" content="More information about {{ $license->license_name }} and books published under it.">
@stop

@section('content')

	<p class="h2">{{ $license->license_name }}</p>
	
	<a href="{{ route('licenses.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> All licenses</a>
	@if($license->license_url)
		<a href="{{ $license->license_url }}" target="_blank" class="btn btn-primary"><i class="fa fa-home fa-lg"></i> Webpage</a>
	@endif
    @if (Auth::check() && Auth::user()->isAdmin())
	    <a href="{{ route('licenses.edit', $license->license_id) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
		<div class="pull-right">
	        {!! Form::open([
	            'method' => 'DELETE',
	            'route' => ['licenses.destroy', $license->license_id]
	        ]) !!}
	        <!-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} -->
	        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete license '{{ $license->license_name }}'" data-message="Are you sure?"><i class="fa fa-trash-o"></i> Delete</button>
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
			<p class="lead">Books published under {{ $license->license_name }}</p>
			<!-- Recent Books -->
			@include('partials.topics.list', array('topics' => $license->topics()->published()->available()->orderBy('topic_published_at','desc')->paginate(15)))
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
