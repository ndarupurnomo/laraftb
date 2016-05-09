@extends('layouts.master')

@section('page-title')
    <title>{{ $license->license_name }} [EDIT]</title>
@stop

@section('content')

<h1>Edit License</h1>
<p class="lead">Edit this license below. <a href="{{ route('licenses.index') }}">Go back to viewing all licenses.</a></p>
<hr>

@include('partials.alerts.errors')

{!! Form::model($license, [
    'method' => 'PATCH',
    'route' => ['licenses.update', $license->license_id],
    'files' => false
]) !!}

@include('partials.licenses.edit')

{!! Form::submit('Update License', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop

