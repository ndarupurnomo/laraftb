@extends('layouts.master')

@section('page-title')
	<title>List of Publishers</title>
	<meta name="description" lang="en" content="List of all book publishers whose books are listed in FreeTechBooks. Click on the publisher names to get more information about them.">
@stop

@section('content')

<h1>Publisher List</h1>
<p class="lead">Here's a list of all publishers whose books are listed in FreeTechBooks (total {{ $count }} publishers). 
@if (Auth::check() && Auth::user()->isAdmin())
<a href="{{ route('publishers.create') }}">Add a new one?</a>
@endif
</p>
<hr>

<div class="row">
	<!-- content column -->
	<div class="col-lg-8 col-md-8">

		<span class="visible-xs visible-sm">
			@include('partials.social')
		</span>

		<table class="table table-hover table-responsive">
			<thead>
				<tr class="active">
					<th>Publisher Name</th>
					<th class="text-center">#Posts</th>
					<!-- <th>Address</th> -->
					@if (Auth::check() && Auth::user()->isAdmin())
					<th class="text-center">Edit</th>
					<th class="text-center">Delete</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($publishers as $publisher)
				<tr>
					<td class="col-md-6">
						<a href="{{ route('slug', ['slug' => $publisher->slug . '-p' . $publisher->publisher_id . '.html']) }}">{{ $publisher->publisher_name }}</a>
					</td>
					<td class="col-md-1 text-center">{{ $publisher->topics->count() }}</td>
					<!-- <td class="col-md-3">{{ $publisher->publisher_address }}</td> -->
					@if (Auth::check() && Auth::user()->isAdmin())
					<td class="col-md-1 text-center">
					    <a href="{{ route('publishers.edit', $publisher->publisher_id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i> Edit</a>
				    </td>
					<td class="col-md-1 text-center">
				        {!! Form::open([
				            'method' => 'DELETE',
				            'route' => ['publishers.destroy', $publisher->publisher_id]
				        ]) !!}
				        <!-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} -->
				        <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete publisher '{{ $publisher->publisher_name }}'" data-message="Are you sure?"><i class="fa fa-trash-o"></i> Delete</button>
				        {!! Form::close() !!}
				    </td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>

		{!! $publishers->links() !!}

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