<div class="media snippet-show-big">
	<p class="lead"><a href="{{ route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']) }}">{{ $author->first_name }} {{ $author->last_name }}</a></p>
	@if ($author->photo)
		{!! Html::image('/' . Config::get('constants.image_path') . '/' . $author->photo, $author->first_name . ' ' . $author->last_name, array('class' => 'thumbnail')) !!}
	@else
		{!! Html::image('/' . Config::get('constants.image_path') . '/' . 'blank-headshot-icon_cr.jpg', $author->first_name . ' ' . $author->last_name, array('class' => 'thumbnail')) !!}
	@endif
	@if ($author->homepage_url)
		<p><a href="{{ $author->homepage_url }}" target="_blank"><i class="fa fa-home"></i> Homepage</a></p>
	@endif
	<p>{!! $author->description_html !!}</p>
</div>
<a href="{{ route('authors.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> Back to all authors</a>
{{--
@if($author->homepage_url)
	<a href="{{ $author->homepage_url }}" target="_blank" class="btn btn-primary"><i class="fa fa-home fa-lg"></i> Homepage</a>
@endif
--}}