@extends('layouts.master')

@section('page-title')
	<title>List of Categories</title>
	<meta name="description" lang="en" content="All categories and sub-categories of books available in FreeTechBooks. Click on the sub-category links to get the books you are looking for.">
@stop

@section('content')

<p class="h1">Book Categories List</p>
<p class="lead">Here's a list of all book categories. Each category has subcategories.
@if (Auth::check() && Auth::user()->isAdmin())
<a href="{{ route('categories.create') }}">Add a new one?</a>
<a href="{{ route('forums.create') }}">Or add a new Sub-Category?</a>
</p>
@endif
<hr>

<div class="row">
	<!-- content column -->
	<div class="col-lg-8 col-md-8">

		<span class="visible-xs visible-sm">
			@include('partials.social')
		</span>

		@foreach($categories as $category)
		    <p class="lead">{{ $category->cat_title }}</p>
			@if (Auth::check() && Auth::user()->isAdmin())
			    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>
					&nbsp;Edit
			    </a>
			    <div class="pull-right"> 
				    {!! Form::open([
				        'method' => 'DELETE',
				        'route' => ['categories.destroy', $category->cat_id]
				    ]) !!}
				    <!-- {!! Form::submit('Delete this Category?', ['class' => 'btn btn-danger']) !!} -->
			        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete category '{{ $category->cat_title }}'" data-message="Are you sure?"><i class="fa fa-trash-o"></i> Delete</button>
				    {!! Form::close() !!}
			    </div>
			    <br/><br/>
			@endif
		 	<table class="table table-hover table-responsive">
				<thead>
					<tr class="active">
						<th>Sub-Categories</th>
						{{--
						<th class="text-center">#Posts</th>
						--}}
						<!-- <th>Address</th> -->
						@if (Auth::check() && Auth::user()->isAdmin())
						<th class="text-center">Edit</th>
						<th class="text-center">Delete</th>
						@endif
					</tr>
				</thead>
				<tbody>
				@foreach($category->forums as $forum)
				<tr>
					<td class="col-md-6">
						<a href="{{ route('slug', ['slug' => $forum->slug . '-f' . $forum->forum_id . '.html']) }}">{{ $forum->forum_name }}</a>
					</td>
			{{--
					<td class="col-md-1 text-center">{{ $forum->topics->count() }}</td>
			--}}
					@if (Auth::check() && Auth::user()->isAdmin())
					<td class="col-md-1 text-center text-nowrap">
						<a href="{{ route('forums.edit', $forum->forum_id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>
							Edit
						</a>
				    </td>
					<td class="col-md-1 text-center">
				        {!! Form::open([
				            'method' => 'DELETE',
				            'route' => ['forums.destroy', $forum->forum_id]
				        ]) !!}
				        <!-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} -->
				        <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete sub-category '{{ $forum->forum_name }}'" data-message="Are you sure?"><i class="fa fa-trash-o"></i>
				        	Delete
			        	</button>
				        {!! Form::close() !!}
				    </td>
					@endif
				</tr>
				@endforeach
				</tbody>
			</table>
			<hr>
		@endforeach
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

