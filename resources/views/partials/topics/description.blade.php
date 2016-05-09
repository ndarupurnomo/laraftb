<p class="media-heading lead"><a href="{{ route('slug', ['slug' => $topic->slug . '-t' . $topic->topic_id . '.html']) }}">{{ $topic->topic_title }}</a></p>
<strong>Post date</strong>: {{ $topic->topic_published_at->format('d M Y') }}<br />
{{ $topic->topic_description }}
<div>
	<strong>Author(s):</strong>
	@foreach($topic->authors()->orderBy('last_name')->orderBy('first_name')->get() as $author)
		<a href="{{ route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']) }}"><i class="fa fa-user"></i> {{ $author->full_name }}</a>
	@endforeach
	<br />
	<strong>Publication date</strong>: {{ $topic->topic_publication_date_formatted }}<br />
	<!-- <strong>Views</strong>: {{ $topic->topic_views_formatted }}<br /> -->
	@if ($topic->license)
		<strong>License</strong>:
		<a href="{{ route('slug', ['slug' => $topic->license->slug . '-l' . $topic->license->license_id . '.html']) }}"><i class="fa fa-university"></i> {{ $topic->license->license_name }}</a>
		<br/>
	@endif
 	@if (Auth::check() && Auth::user()->isAdmin())
		<strong>Views</strong>: {{ $topic->topic_views_formatted }}
		<br/>
 	@endif
	<strong>Tags:</strong>
	@foreach($topic->forums()->orderBy('forum_name')->get() as $forum)
		<a href="{{ route('slug', ['slug' => $forum->slug . '-f' . $forum->forum_id . '.html']) }}" ><i class="fa fa-book"></i> {{ $forum->forum_name }}</a>
	@endforeach

</div>
