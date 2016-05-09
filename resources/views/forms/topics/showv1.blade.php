@extends('layouts.master')

@section('page-title')
	<title>{{ $topic->topic_title }}</title>
	<meta name="description" lang="en" content="{{ $topic->topic_description }}">
	<meta property="og:url"            content="{{ url()->current() }}" />
	<meta property="og:type"           content="book" />
	<meta property="og:title"          content="{{ $topic->topic_title }}" />
	<meta property="og:description"    content="{{ $topic->topic_description }}" />
	<meta property="og:image"          content="{{ Request::root() . '/' . Config::get('constants.image_path') . '/' . $topic->topic_cover }}" />
@stop

@section('content')

<div class="row">
	<!-- content column -->
	<div class="col-lg-8 col-md-8">

		<span class="visible-lg visible-md visible-sm">
			<div class="media-left">
				@if ($topic->topic_cover)
					{!! Html::image('/' . Config::get('constants.image_path') . '/' . $topic->topic_cover, $topic->topic_title, array('class' => 'thumbnail', 'style' => 'width:180px;height:auto')) !!}
				@else
					{!! Html::image('/' . Config::get('constants.image_path') . '/' . 'new-dark-grey-background_cr.jpg', $topic->topic_title, array('class' => 'thumbnail', 'style' => 'width:180px;height:auto')) !!}
				@endif
			</div>
			<div class="media-body">
		    	<p class="media-heading lead">{{ $topic->topic_title }}</p>
				<p>{{ $topic->topic_description }}</p>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-md-12">
						<p>
							@include('partials.topics.tags')
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-md-6">
						<p><strong>Publication date</strong>: {{ $topic->topic_publication_date_formatted }}</p>
						<p>
							@include('partials.topics.isbn10')
						</p>						
						<p>
							@include('partials.topics.isbn13')
						</p>
						<p>
							@include('partials.topics.paperback')
						</p>
						<p><strong>Views</strong>: {{ $topic->topic_views_formatted }}</p>
					</div>
					<div class="col-lg-6 col-md-6 col-md-6">
						<p>
							@include('partials.topics.publishers')
						</p>
						<p>
							@include('partials.topics.license')
						</p>
						<p><strong>Post time</strong>: {{ $topic->topic_published_at_formatted }}</p>

					</div>
				</div>
			</div>
	  	</span>	
		<span class="visible-xs">
			<div class="media snippet-show">
			    <p class="media-heading h3">{{ $topic->topic_title }}</p>
			    <div class="row"> 
				    <div class="col-xs-12">
			    		@if ($topic->topic_cover)
							{!! Html::image('/' . Config::get('constants.image_path') . '/' . $topic->topic_cover, $topic->topic_title, array('class' => 'thumbnail')) !!}
						@else
							{!! Html::image('/' . Config::get('constants.image_path') . '/' . 'new-dark-grey-background_cr.jpg', $topic->topic_title, array('class' => 'thumbnail')) !!}
						@endif
				    {{ $topic->topic_description }}
				    <br/>
				    </div>
			    </div>
			    <div>
			    	@include('partials.topics.tags')
					<br/>
					<strong>Publication date</strong>: {{ $topic->topic_publication_date_formatted }}
					<br/>
					@include('partials.topics.isbn10')
					<br/>
					@include('partials.topics.isbn13')
					<br/>
					@include('partials.topics.paperback')
					<br/>
					<strong>Views</strong>: {{ $topic->topic_views_formatted }}
					<br/>
					@include('partials.topics.publishers')
					<br/>
					@include('partials.topics.license')
					<br/>
					<strong>Post time</strong>: {{ $topic->topic_published_at_formatted }}
					<br/>

				</div>
			</div>
		</span>

		<br />
		@include('partials.ads.tribalfusion728x90')

		<div class="media">
			<div>{!! $topic->topic_post_text_html !!}</div> 
			<br/> 
				
			<span class="visible-lg visible-md visible-sm">
	        	<ul class="list-inline">
		        	<li><a href="{{ $topic->topic_download_url }}" class="btn btn-primary"><i class="fa fa-download"></i> Download this Book</a></li>
					@if ($topic->topic_ISBN10)
		        		<li><a href="http://www.amazon.com/exec/obidos/ASIN/{{ $topic->topic_ISBN10 }}/ref=nosim/freetechboo0c-20" class="btn btn-primary"><i class="fa fa-amazon"></i> Buy it from Amazon</a></li>
		        	@endif
	        	</ul>
		    </span>
			<span class="visible-xs">
	        	<ul class="list-inline">
		        	<li><a href="{{ $topic->topic_download_url }}" class="btn btn-primary"><i class="fa fa-download"></i> Download</a></li>
					@if ($topic->topic_ISBN10)
		        		<li><a href="http://www.amazon.com/exec/obidos/ASIN/{{ $topic->topic_ISBN10 }}/ref=nosim/freetechboo0c-20" class="btn btn-primary"><i class="fa fa-amazon"></i> Buy from Amazon</a></li>
		        	@endif
		    	</ul>
		    </span>

			<br/><br/>

		 	@if (Auth::check() && Auth::user()->isAdmin())
		 		<p><strong>Scheduled for publication on</strong>: {{ $topic->topic_published_at_formatted }}</p>
				<!-- <p><strong>Current status</strong>: {{ $topic->topic_status }}</p> -->
				<p><strong>Last edit time</strong>: {{ $topic->updated_at_formatted }}</p>
				<p><strong>Edit count</strong>: {{ $topic->topic_post_edit_count }}</p>
				<p>&nbsp;</p>
				<a href="{{ route('topics.edit', $topic->topic_id) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Edit this Book</a>
				<div class="pull-right">
			        {!! Form::open([
			            'method' => 'DELETE',
			            'id' => 'delete_' . $topic->topic_id,
			            'route' => ['topics.destroy', $topic->topic_id]
			        ]) !!}
			        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete book '{{ $topic->topic_title }}'" data-message="Are you sure?"><i class="fa fa-trash-o"></i> Delete</button>
			        {!! Form::close() !!}
				</div>
				<br/><br/>
			@endif
			@include('partials.ads.tribalfusion300x250')

		</div>

	</div>

	<!-- side navigation column -->
	<div class="col-lg-4 col-md-4">

		@include('partials.authors.list', array('authors' => $topic->authors()->orderBy('last_name')->orderBy('first_name')->get()))

		@include('partials.ads.tribalfusion300x250')

		<!-- @include('partials.topics.popular') -->

	</div>
</div>

@stop


@section('extra-footer')

@include('partials.alerts.confirmdelete')

@stop

