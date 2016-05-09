@foreach($posts as $post)
<div class="row">
	<div class="col-xs-12">
		<p class="lead"><strong><a href="{{ route('slug', ['slug' => $post->slug . '-b' . $post->ID . '.html']) }}">{{ $post->title }}</a></strong></p>
	</div>
	<div class="col-lg-3 col-md-3">
		<div><strong>Post date:</strong> {{ $post->created_at_formatted }}</div>
		<div><strong>Author:</strong> {{ $post->author->nickname }}</div>
		<br/>
	</div>
	<div class="col-lg-9 col-md-9">
		<div>
			@if($excerpt == 'yes')
				{!! $post->content_read_more !!}
				<a href="{{ route('slug', ['slug' => $post->slug . '-b' . $post->ID . '.html']) }}">Read more...</a>
			@else
				{!! $post->content_full !!}
			@endif
		</div>
	</div>
</div>
<br/>
@endforeach

@if (method_exists($posts, 'links'))
	@if(isset($module))
		{{ $topics->appends(['query' => $query])->links() }}
	@else
		{!! $posts->links() !!}
	@endif
@endif
