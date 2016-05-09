@foreach($serps as $serp)
<div class="row">
	<div class="col-xs-12">
	</div>
</div>
@endforeach

@if (method_exists($serps, 'links'))
	@if(isset($module))
		{{ $serps->appends(['query' => $query])->links() }}
	@else
		{!! $serps->links() !!}
	@endif
@endif