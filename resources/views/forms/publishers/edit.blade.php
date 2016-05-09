@extends('layouts.master')

@section('page-title')
    <title>{{ $publisher->publisher_name }} [EDIT]</title>
@stop

@section('content')

<h1>Edit Publisher</h1>
<p class="lead">Edit this publisher below. <a href="{{ route('publishers.index') }}">Go back to viewing all publishers.</a></p>
<hr>

@include('partials.alerts.errors')

{!! Form::model($publisher, [
    'method' => 'PATCH',
    'route' => ['publishers.update', $publisher->publisher_id],
    'files' => false
]) !!}

@include('partials.publishers.edit')

{!! Form::submit('Update Publisher', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop

@section('extra-footer')

@include('partials.controls.ckeditor', array('control_field' => 'publisher_address'))

@stop
