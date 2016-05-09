@extends('layouts.master')

@section('page-title')
	<title>List of Licenses</title>
	<meta name="description" lang="en" content="List of all free document licenses used by books posted in FreeTechBooks. Click on the license names to get more information about them.">
@stop

@section('content')

<h1>License List</h1>
<p class="lead">Here's a list of all free document licenses used by books listed in FreeTechBooks (total {{ $count }} types of license). 
@if (Auth::check() && Auth::user()->isAdmin())
<a href="{{ route('licenses.create') }}">Add a new one?</a>
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
					<th>License Name</th>
					<th class="text-center">#Posts</th>
					<!-- <th>Address</th> -->
					@if (Auth::check() && Auth::user()->isAdmin())
					<th class="text-center">Edit</th>
					<th class="text-center">Delete</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($licenses as $license)
				<tr>
					<td class="col-md-6">
						<a href="{{ route('slug', ['slug' => $license->slug . '-l' . $license->license_id . '.html']) }}">{{ $license->license_name }}</a>
					</td>
					<td class="col-md-1 text-center">{{ $license->topics->count() }}</td>
					@if (Auth::check() && Auth::user()->isAdmin())
					<td class="col-md-1 text-center">
					    <a href="{{ route('licenses.edit', $license->license_id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i> Edit</a>
				    </td>
					<td class="col-md-1 text-center">
				        {!! Form::open([
				            'method' => 'DELETE',
				            'route' => ['licenses.destroy', $license->license_id]
				        ]) !!}
				        <!-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} -->
				        <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete license '{{ $license->license_name }}'" data-message="Are you sure?"><i class="fa fa-trash-o"></i> Delete</button>
				        {!! Form::close() !!}
				    </td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>

		{!! $licenses->links() !!}
		
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

