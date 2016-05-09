<strong>License</strong>:  
@if ($topic->license)
	@if ($topic->license->license_url)
		<a href="{{ $topic->license->license_url }}" target="_blank"><i class="fa fa-university"></i> {{ $topic->license->license_name }}</a>
	@else
		<i class="fa fa-university"></i> {{ $topic->license->license_name }}
	@endif
@else
	n/a
@endif
