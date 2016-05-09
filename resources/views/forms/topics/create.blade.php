@extends('layouts.master')

@section('page-title')
    <title>Add a New Book</title>
@stop

@section('extra-header')
    <!-- select2 -->
    <link rel="stylesheet" type="text/css" href="/bower_components/select2/dist/css/select2.min.css">
@stop

@section('content')

<h1>Add a New Book</h1>
<hr>

@include('partials.alerts.errors')

{!! Form::open([
    'route' => 'topics.store',
    'files' => true
]) !!}

@include('partials.topics.edit')

{!! Form::submit('Add New Book', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop

@section('extra-footer')

@include('partials.controls.ckeditor', array('control_field' => 'topic_post_text'))

@include('partials.topics.select2')

@endsection
