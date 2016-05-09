@extends('layouts.master')

@section('page-title')
    <title>Add a New Author</title>
@stop

@section('content')

<h1>Add a New Author</h1>
<p class="lead">Add to the author list below.</p>
<hr>

@include('partials.alerts.errors')

{!! Form::open([
    'route' => 'authors.store',
    'files' => true
]) !!}

@include('partials.authors.edit')

{!! Form::submit('Create New Author', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop

@section('extra-footer')

@include('partials.controls.ckeditor', array('control_field' => 'description'))

@stop
