@extends('layouts.master')

@section('page-title')
	<title>List of All Authors (for checking purposes)</title>
	<meta name="description" lang="en" content="List of all authors listed in FreeTechBooks. For checking purposes.">
@stop

@section('content')

<h1>All Authors List</h1>
<p class="lead">Here's a list of all Authors. 
</p>
<hr>

<div class="row">
	<!-- content column -->
	<div class="col-xs-12">
		@foreach($authors as $author)
			@if($author->homepage_url)
				<p><a href="{{ $author->homepage_url }}" rel="nofollow">{{ $author->author_id }} - {{ $author->last_name }}, {{ $author->first_name }}</a></p>
			@endif
		@endforeach
		{!! $authors->links() !!}
	</div>

</div>

@stop

@section('extra-footer')

@stop

