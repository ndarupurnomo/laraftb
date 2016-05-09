@extends('layouts.master')

@section('page-title')
    <title>{{ $topic->topic_title }} [EDIT]</title>
@stop

@section('extra-header')
    <!-- select2 -->
    <link rel="stylesheet" type="text/css" href="/bower_components/select2/dist/css/select2.min.css">
@stop

@section('content')

<h1>Edit Book</h1>
<p class="lead">Edit this book below. <a href="{{ route('slug', ['slug' => $topic->slug . '-t' . $topic->topic_id . '.html']) }}">Go back to viewing this book.</a></p>
<hr>

@include('partials.alerts.errors')

{!! Form::model($topic, [
    'method' => 'PATCH',
    'route' => ['topics.update', $topic->topic_id],
    'files' => true
]) !!}

@include('partials.topics.edit')

{!! Form::submit('Update Book', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop

@section('extra-footer')

@include('partials.controls.ckeditor', array('control_field' => 'topic_post_text'))

@include('partials.topics.select2')

@stop
