@extends('layouts.master')

@section('page-title')
	<title>{{ $topic->topic_title }}</title>
	<meta name="description" lang="en" content="{{ $topic->topic_description }}">
	<meta property="fb:app_id" content="157651454628891" />
	<meta property="og:url" content="{{ url()->current() }}" />
	<meta property="og:type" content="Book" />
	<meta property="og:title" content="{{ $topic->topic_title }}" />
	<meta property="og:description" content="{{ $topic->topic_description }}" />
	<meta property="og:image" content="{{ Request::root() . '/' . Config::get('constants.image_path') . '/' . $topic->topic_cover }}" />
@stop

@section('extra-header')
@if ($topic->topic_tla == '')
{{--
	@include('partials.ads.survataload')
--}}
@endif
@stop

@section('pre-body')
	@include('partials.facebook.setup')
@stop

@section('content')

@if ($topic->topic_tla == '')
{{--
	@include('partials.ads.survataready')
--}}
@endif

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

{{--
    	<div class="thumbnail" style="background: #DFF0D8;">
    	<p class="bg-success">Want to download the list of all books ever posted in FreeTechBooks? You'll get a single Excel file which you can search, sort, group, or whatever you need.</p>
    	</div>
--}}

		<div class="media">
			@if ($topic->topic_tla !== '')
				<div><strong>{!! $topic->topic_tla_html !!}</strong></div>
				<br/>
			@endif

			<div>{!! $topic->topic_post_text_html !!}</div> 
			<br/> 

			<div id="teaser-content">
				<div id="teaser-fade"></div>
			</div>

			@if ($topic->topic_tla == '')
{{--
			<div id="srvata-loader">
				<img src="http://survatacdn.com/loaders/circles_medium.gif">
			</div>
--}}
			@endif

        	<ul class="list-inline">
				@if ($topic->topic_tla == '')
{{--
	    		<li><a id="srvata-link" class="btn btn-primary"> 
	    			<span class="visible-xs">
	    				<i class="fa fa-commenting" aria-hidden="true"></i> Take a survey to download this Book
	    			</span>
	    			<span class="visible-lg visible-md visible-sm">
	    				<i class="fa fa-commenting" aria-hidden="true"></i> Take a short survey to download this Book
	    			</span>
	    		</a></li>
--}}
	    		@endif
				<div id="srvata-content">

		        	<li><a href="{{ $topic->topic_download_url }}" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i> Download this Book</a></li>
					{{--
					@if ($topic->topic_ISBN10)
		        		<li><a href="http://www.amazon.com/exec/obidos/ASIN/{{ $topic->topic_ISBN10 }}/ref=nosim/freetechboo0c-20" target="_blank" class="btn btn-primary"><i class="fa fa-amazon"></i> Buy it from Amazon</a></li>
		        	@endif
		        	--}}
	        	</div>

	    	</ul>
	    	@if ($topic->topic_tla == '')
{{--
				@include('partials.ads.survatastart')
--}}
			@endif
			<br/>



{{--
			@include('partials.ads.tribalfusion728x90')
--}}	

			@include('partials.facebook.share')
			@include('partials.twitter.tweet')
			<br/><br/>

			@include('partials.authors.list', array('authors' => $topic->authors()->orderBy('last_name')->orderBy('first_name')->get()))

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
			@include('partials.ads.tribalfusion728x90')
		</div>


	</div>

	<!-- side navigation column -->
	<div class="col-lg-4 col-md-4">

		<span class="visible-md visible-lg">
			@include('partials.social')
		</span>

		@include('partials.categories.list')
		
		@include('partials.ads.tribalfusion300x250')

		<span class="visible-xs visible-sm">
			@include('partials.social')
		</span>

	</div>
</div>

@stop


@section('extra-footer')

@include('partials.alerts.confirmdelete')


@stop

