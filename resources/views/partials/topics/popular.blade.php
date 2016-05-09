<div class="list-group">
    <div class="list-group-item active">Most Popular Books</div>
    @foreach($populars as $popular)
		<a href="{{ route('slug', ['slug' => $popular->slug . '-t' . $popular->topic_id . '.html']) }}" class="list-group-item">
			<span class="badge">{{ $popular->topic_views_formatted }}</span>
			{{ $popular->topic_title }}
		</a>
    @endforeach
</div>