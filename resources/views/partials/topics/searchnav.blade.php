{!! Form::open([
  'method' => 'GET',
  'route' => 'topics.search', 
  'class' => 'form navbar-form navbar-left searchform'
]) !!}

<div class="input-group">
  {!! Form::text('query', null, array('required', 'class' => 'form-control', 'placeholder' => 'Search for a title (e.g. \'intro\')')) !!}
  <span class="input-group-btn">
    {!! Form::submit('Go!', array('class' => 'btn btn-success')) !!}
  </span>
</div>

{!! Form::close() !!}
