<div class="list-group">
  <div class="list-group-item active">Book Categories</div>
  @foreach($categories as $category)
    <a data-toggle="collapse" href="#collapse{{ $category->cat_id }}" aria-expanded="false" aria-controls="collapse{{ $category->cat_id }}" class="list-group-item">
      {{ $category->cat_title_less }}<span class="pull-right"><i class="fa fa-chevron-down fa-lg" aria-hidden="true"></i></span>
    </a>
    <div class="collapse" id="collapse{{ $category->cat_id }}">
      @foreach($category->forums as $forum)
        @if($forum->topics->count())
        <a href="{{ route('slug', ['slug' => $forum->slug . '-f' . $forum->forum_id . '.html']) }}" class="list-group-item">
          <span class="badge">{{ $forum->topics->count() }}</span>
          &nbsp;&nbsp;&nbsp;&nbsp;{{ $forum->forum_name }}
        </a>
        @endif
      @endforeach
    </div>
  @endforeach
</div>

@include('partials.topics.browse')

{{--
<p class="lead">Categories</p>
<hr>


<ul class="nav nav-pills nav-stacked">
  @foreach($categories as $category)
  <li role="presentation" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ $category->cat_title }}<span class="caret pull-right"></span></a>
  <ul class="dropdown-menu">
    @foreach($category->forums as $forum)
      @if($forum->topics->count())
        <li><a href="{{ route('slug', ['slug' => $forum->slug . '-f' . $forum->forum_id . '.html']) }}">{{ $forum->forum_name }} <span class="badge">{{ $forum->topics->count() }}</span></a></li>
      @endif
    @endforeach
  </ul>
  </li>
  @endforeach
</ul>

<ul class="nav nav-pills nav-stacked">
  @foreach($categories as $category)
  <!-- <li role="presentation"><a href="#">{{ $category->cat_title }}</a></li> -->
  <li role="presentation" class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      {{ $category->cat_title }}<span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      @foreach($category->forums as $forum)
        @if($forum->topics->count())
          <li><a href="{{ route('slug', ['slug' => $forum->slug . '-f' . $forum->forum_id . '.html']) }}">{{ $forum->forum_name }} <span class="badge">{{ $forum->topics->count() }}</span></a></li>
        @endif
      @endforeach
    </ul>
  </li>

  @endforeach
</ul>

<div class="btn-group-vertical" role="group">
  @foreach($categories as $category)
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      {{ $category->cat_title }}
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      @foreach($category->forums as $forum)
        @if($forum->topics->count())
          <li><a href="{{ route('slug', ['slug' => $forum->slug . '-f' . $forum->forum_id . '.html']) }}"><span class="badge">{{ $forum->topics->count() }}</span>
 			{{ $forum->forum_name }}</a></li>
        @endif
      @endforeach
    </ul>
  </div>
  @endforeach
</div>
--}}

{{--
<div class="list-group">
@foreach($categories as $category)
	<!-- <a data-toggle="collapse" href="#cat{{ $category->cat_id }}" class="list-group-item active">{{ $category->cat_title }}</a> -->
	<div class="list-group-item active">{{ $category->cat_title }}</div>
	<!-- <div id="cat{{ $category->cat_id }}" class="collapse"> -->
	@foreach($category->forums as $forum)
		@if($forum->topics->count())
		<a href="{{ route('slug', ['slug' => $forum->slug . '-f' . $forum->forum_id . '.html']) }}" class="list-group-item">
			<span class="badge">{{ $forum->topics->count() }}</span>
 			{{ $forum->forum_name }}
		</a>
		@endif
	@endforeach
	<!-- </div> -->
@endforeach
</div>
--}}