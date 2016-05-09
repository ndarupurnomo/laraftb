@extends('layouts.master')

@section('page-title')
    <title>{{ $author->full_name }} [EDIT]</title>
@stop

@section('content')

<h1>Edit Author</h1>
<p class="lead">Edit this author below. <a href="{{ route('slug', ['slug' => $author->slug . '-a' . $author->author_id . '.html']) }}">Go back to viewing this author.</a></p>
<hr>

@include('partials.alerts.errors')

{!! Form::model($author, [
    'method' => 'PATCH',
    'route' => ['authors.update', $author->author_id],
    'files' => true
]) !!}

@include('partials.authors.edit')

{!! Form::submit('Update Author', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop

@section('extra-footer')

@include('partials.controls.ckeditor', array('control_field' => 'description'))

@stop
