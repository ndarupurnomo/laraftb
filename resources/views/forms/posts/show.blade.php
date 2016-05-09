@extends('layouts.master')

@section('page-title')
	<title>{{ $post->title }}</title>
	<meta name="description" lang="en" content="{{ $post->title }}">
@stop

@section('content')

<a href="{{ route('posts.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> See all notes</a>
<p class="h1">{{ $post->title }}</p>
<hr>

<div class="row">
	<!-- content column -->
	<div class="col-lg-8 col-md-8">

		<span class="visible-xs visible-sm">
			@include('partials.social')
		</span>

		<div class="row">
			@if ($type == 'page')
				<div class="col-lg-12 col-md-12">
					<div>
						{!! $post->content_full !!}
					</div>
				</div>
			@else
				<div class="col-lg-3 col-md-3">
					<div><strong>Post date:</strong> {{ $post->created_at_formatted }}</div>
					<div><strong>Author:</strong> {{ $post->author->nickname }}</div>
					<br/>
				</div>
				<div class="col-lg-9 col-md-9">
					<div>
						{!! $post->content_full !!}
					</div>
				</div>
			@endif
		</div>

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

