@foreach($topics as $topic)
<div class="row">
	<div class="col-xs-12">
	<span class="visible-lg visible-md visible-sm">
		<div class="media">
		  <div class="media-left">
		    <a href="{{ route('slug', ['slug' => $topic->slug . '-t' . $topic->topic_id . '.html']) }}">
	    		@if ($topic->topic_cover)
					{!! Html::image('/' . Config::get('constants.image_path') . '/' . $topic->topic_cover, $topic->topic_title, array('class' => 'media-object thumbnail', 'style' => 'width:140px;height:auto')) !!}
				@else
					{!! Html::image('/' . Config::get('constants.image_path') . '/' . 'new-dark-grey-background_cr.jpg', $topic->topic_title, array('class' => 'media-object thumbnail', 'style' => 'width:140px;height:auto')) !!}
				@endif
		    </a>
		  </div>
		  <div class="media-body">

		      @include('partials.topics.description')

		  </div>
		  <div class="min-space">&nbsp;</div>
  		</div>
  	</span>	
	<span class="visible-xs">
		<div class="media snippet-list">
    		@if ($topic->topic_cover)
				{!! Html::image('/' . Config::get('constants.image_path') . '/' . $topic->topic_cover, $topic->topic_title, array('class' => 'thumbnail')) !!}
			@else
				{!! Html::image('/' . Config::get('constants.image_path') . '/' . 'new-dark-grey-background_cr.jpg', $topic->topic_title, array('class' => 'thumbnail')) !!}
			@endif

		  	@include('partials.topics.description')

			<br/><br/>
		</div>
	</span>
	</div>
</div>
@endforeach

@if (method_exists($topics, 'links'))
	@if(isset($module))
		{{ $topics->appends(['query' => $query])->links() }}
	@else
		{!! $topics->links() !!}
	@endif
@endif