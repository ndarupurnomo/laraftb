@extends('layouts.master')

@section('page-title')
	<title>List of Authors</title>
	<meta name="description" lang="en" content="List of all authors whose books are posted in FreeTechBooks. Click on the author names to get more information about them.">
@stop

@section('content')

<h1>Author List</h1>
<p class="lead">Here's a list of all authors whose books are listed in FreeTechBooks (total {{ $count }} authors). 
@if (Auth::check() && Auth::user()->isAdmin())
	<a href="{{ route('authors.create') }}">Add a new one?</a>
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
					<th>Last Name</th>
					<th>First Name</th>
					<th class="text-center">#Posts</th>
					<!-- <th>Address</th> -->
					@if (Auth::check() && Auth::user()->isAdmin())
					<th class="text-center">Edit</th>
					<th class="text-center">Delete</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($authors as $author)
				<tr>
					<td class="col-md-3">
						<a href="{{ route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']) }}">{{ $author->last_name }}</a>
					</td>
					<td class="col-md-3">
						<a href="{{ route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']) }}">{{ $author->first_name }}</a>
					</td>
					<td class="col-md-1 text-center">{{ $author->topics->count() }}</td>
					@if (Auth::check() && Auth::user()->isAdmin())
					<td class="col-md-1 text-center">
					    <a href="{{ route('authors.edit', $author->author_id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i> Edit</a>
				    </td>
					<td class="col-md-1 text-center">
   					    <!-- <a href="{{ route('authors.edit', $author->author_id) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a> -->
				        {!! Form::open([
				            'method' => 'DELETE',
				            'id' => 'delete_' . $author->author_id,
				            'route' => ['authors.destroy', $author->author_id]
				        ]) !!}
				        <!-- <button id="delete" class="btn btn-danger btn-xs">cDelete</button> -->
				        <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete author '{{ $author->full_name }}'" data-message="Are you sure?"><i class="fa fa-trash-o"></i> Delete</button>
				        <!-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} -->
				        <!-- {!! Form::submit('Submit') !!} -->
					    <!-- <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o"></i> Delete</button> -->
					    <!-- <button type="button" class="btn btn-danger btn-xs myBtn" id="myBtn"><i class="fa fa-trash-o"></i> Delete</button> -->
				        {!! Form::close() !!}
				    </td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>

		{!! $authors->links() !!}

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

@include('partials.alerts.confirmdelete')

@stop

