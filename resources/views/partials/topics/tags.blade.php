<strong>Tag(s):</strong>
@foreach($topic->forums()->orderBy('forum_name')->get() as $forum)
	<a href="{{ route('slug', ['slug' => $forum->slug . '-f' . $forum->forum_id . '.html']) }}" ><i class="fa fa-book"></i> {{ $forum->forum_name }}</a>
@endforeach
