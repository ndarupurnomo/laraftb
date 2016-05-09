<strong>Publisher</strong>:
@if ($topic->publisher)
	@if ($topic->publisher->publisher_url)
		<a href="{{ $topic->publisher->publisher_url }}" target="_blank"><i class="fa fa-building-o"></i> {{ $topic->publisher->publisher_name }}</a>
	@else
		<i class="fa fa-building-o"></i> {{ $topic->publisher->publisher_name }}
	@endif
@else
	n/a
@endif
