@extends('layouts.master')

@section('page-title')
    <title>Add a New License</title>
@stop

@section('content')

<h1>Add a New License</h1>
<p class="lead">Add to the licenses list below.</p>
<hr>

@include('partials.alerts.errors')

{!! Form::open([
    'route' => 'licenses.store',
    'files' => false
]) !!}

@include('partials.licenses.edit')

{!! Form::submit('Create New License', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop

