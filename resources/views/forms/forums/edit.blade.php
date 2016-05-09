@extends('layouts.master')

@section('page-title')
    <title>{{ $forum->forum_name }} [EDIT]</title>
@stop

@section('extra-header')
    <!-- select2 -->
    <link rel="stylesheet" type="text/css" href="/bower_components/select2/dist/css/select2.min.css">
@stop

@section('content')

<h1>Edit Sub-Category</h1>
<p class="lead">Edit this sub-category below. <a href="{{ route('categories.index') }}">Go back to category list.</a></p>
<hr>

@include('partials.alerts.errors')

{!! Form::model($forum, [
    'method' => 'PATCH',
    'route' => ['forums.update', $forum->forum_id],
    'files' => true
]) !!}

@include('partials.forums.edit')

{!! Form::submit('Update Sub-Category', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop

@section('extra-footer')

@include('partials.forums.select2')

@stop
