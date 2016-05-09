<div class="media snippet-list">
	<p class="lead"><a href="{{ route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']) }}">{{ $author->first_name }} {{ $author->last_name }}</a></p>
	@if ($author->photo)
		{!! Html::image('/' . Config::get('constants.image_path') . '/' . $author->photo, $author->first_name . ' ' . $author->last_name, array('class' => 'thumbnail')) !!}
	@else
		{!! Html::image('/' . Config::get('constants.image_path') . '/' . 'blank-headshot-icon_cr.jpg', $author->first_name . ' ' . $author->last_name, array('class' => 'thumbnail')) !!}
	@endif
	<!-- <p>{!! $author->description_html !!}</p> -->
	@if ($author->homepage_url)
		<a href="{{ $author->homepage_url }}" ><i class="fa fa-home"></i> Homepage</a>
	@endif
</div>
@unless ($author->description)
@endunless
<!-- <a href="{{ route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']) }}" class="btn btn-primary"><i class="fa fa-info-circle"></i> More</a> -->
