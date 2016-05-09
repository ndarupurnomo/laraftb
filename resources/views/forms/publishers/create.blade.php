@extends('layouts.master')

@section('page-title')
    <title>Add a New Publisher</title>
@stop

@section('content')

<h1>Add a New Publisher</h1>
<p class="lead">Add to the publisher list below.</p>
<hr>

@include('partials.alerts.errors')

{!! Form::open([
    'route' => 'publishers.store',
    'files' => false
]) !!}

@include('partials.publishers.edit')

{!! Form::submit('Create New Publisher', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop

@section('extra-footer')

@include('partials.controls.ckeditor', array('control_field' => 'publisher_address'))

@stop
