{{--
{!! Form::open([
	'method' => 'GET',
	'route' => 'topics.search', 
	'class' => 'form searchform'
]) !!}
--}}
{!! Form::open([
	'method' => 'GET',
	'url' => 'https://www.google.com/search', 
	'class' => 'form searchform',
	'onsubmit' => 'doSubmit();',
	'name' => 'myform',
	'id' => 'myform'
]) !!}
<div class="input-group">
	{!! Form::text('q', null, array('required', 'target' => '_blank', 'id' => 'q', 'class' => 'form-control input-lg', 'placeholder' => 'For better result, do one-word search (e.g. \'algorithms\', \'c#\', \'math\', etc.)')) !!}
	<span class="input-group-btn">
		{!! Form::submit('Search', array('class' => 'btn btn-success btn-lg')) !!}
	</span>
</div>
{!! Form::close() !!}
<br>

<script type="text/javascript">
function doSubmit(){
  document.getElementById("q").value = document.getElementById("q").value + " site:freetechbooks.com";
  return true;
}
</script>