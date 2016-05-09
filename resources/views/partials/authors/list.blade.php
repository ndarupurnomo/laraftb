<!-- <li class="list-group-item active">About The Author(s)</li> -->
<p class="lead">About The Author(s)</p>
<hr>

{{--
<ul class="list-inline">
    @foreach($authors as $author)
		<li class="list-group-item">
			@include('partials.authors.snippedlist')
		</li>
    @endforeach
</ul>
--}}

{{--
@foreach ($authors->chunk(2) as $chunk)

<div class="row">
  @foreach ($chunk as $author)
  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
    <div class="media-left snippet-list">
		@if ($author->photo)
			{!! Html::image('/' . Config::get('constants.image_path') . '/' . $author->photo, $author->first_name . ' ' . $author->last_name, array('class' => 'thumbnail')) !!}
		@else
			{!! Html::image('/' . Config::get('constants.image_path') . '/' . 'blank-headshot-icon_cr.jpg', $author->first_name . ' ' . $author->last_name, array('class' => 'thumbnail')) !!}
		@endif
    </div>
	<div class="media-body">
		<p class="media-heading"><a href="{{ route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']) }}"><i class="fa fa-user"></i> {{ $author->first_name }} {{ $author->last_name }}</a></p>
		@if ($author->homepage_url)
			<a href="{{ $author->homepage_url }}" target="_blank"><i class="fa fa-home"></i> Homepage</a>
		@endif
		<!-- <p>Lorem ipsum dolor sit amet, per ea dolore eripuit dissentias, mea ridens laoreet ea. An mel munere deleniti, usu eu nostrud volumus denique. Ut quodsi volutpat scriptorem cum. Qui ex dolore offendit. Aeque nihil graecis at vis, ne duo salutatus abhorreant necessitatibus, his et vulputate temporibus. In oblique ocurreret nec, et mei facilisi maluisset consulatu. Commodo laoreet mediocritatem sea te, soluta tempor efficiendi has cu.</p> -->
		<!-- <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p> -->
	</div>
  </div>
  @endforeach
</div>
<br/>

@endforeach
--}}

@foreach ($authors as $author)

<div class="row">
  <div class="col-xs-12">
	<span class="visible-lg visible-md visible-sm">
		<div class="media">
		  <div class="media-left">
		    <a href="{{ route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']) }}">
	    		@if ($author->photo)
					{!! Html::image('/' . Config::get('constants.image_path') . '/' . $author->photo, $author->full_name, array('class' => 'media-object thumbnail', 'style' => 'width:140px;height:auto')) !!}
				@else
					{!! Html::image('/' . Config::get('constants.image_path') . '/' . 'blank-headshot-icon_cr.jpg', $author->full_name, array('class' => 'media-object thumbnail', 'style' => 'width:140px;height:auto')) !!}
				@endif
		    </a>
		  </div>
		  <div class="media-body">

			<ul class="list-inline">
			<li>
				<a href="{{ route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']) }}"><i class="fa fa-user"></i> {{ $author->first_name }} {{ $author->last_name }}</a>
			</li>
			@if ($author->homepage_url)
			<li>
				<a href="{{ $author->homepage_url }}" target="_blank"><i class="fa fa-home"></i> Homepage</a>
			</li>
			@endif
			</ul>
			<p>{!! $author->description_html !!}</p>

		  </div>
		</div>
	</span>	
	<span class="visible-xs">
		<div class="media snippet-list">
			<a href="{{ route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']) }}">
				@if ($author->photo)
					{!! Html::image('/' . Config::get('constants.image_path') . '/' . $author->photo, $author->full_name, array('class' => 'thumbnail')) !!}
				@else
					{!! Html::image('/' . Config::get('constants.image_path') . '/' . 'blank-headshot-icon_cr.jpg', $author->full_name, array('class' => 'thumbnail')) !!}
				@endif
			</a>
			<ul class="list-inline">
			<li>
				<a href="{{ route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']) }}"><i class="fa fa-user"></i> {{ $author->first_name }} {{ $author->last_name }}</a>
			</li>
			@if ($author->homepage_url)
			<li>
				<a href="{{ $author->homepage_url }}" target="_blank"><i class="fa fa-home"></i> Homepage</a>
			</li>
			@endif
			</ul>
			<p>{!! $author->description_html !!}</p>

		</div>
	</span>

  </div>
</div>
<br/>

@endforeach
