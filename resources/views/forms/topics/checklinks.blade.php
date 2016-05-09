@extends('layouts.master')

@section('page-title')
	<title>List of All Books (for checking purposes)</title>
	<meta name="description" lang="en" content="List of all books available in FreeTechBooks. For checking purposes.">
@stop

@section('content')

<h1>All Books List</h1>
<p class="lead">Here's a list of all Books. 
</p>
<hr>

<div class="row">
	<!-- content column -->
	<div class="col-xs-12">
		@foreach($topics as $topic)
			<p><a href="{{ $topic->topic_download_url }}" rel="nofollow">{{ $topic->topic_id }} - {{ $topic->topic_title }}</a></p>
		@endforeach
		{!! $topics->links() !!}
	</div>

</div>

@stop

@section('extra-footer')

@stop

