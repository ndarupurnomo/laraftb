@extends('layouts.master')

@section('content')

<h1>Add a New Book</h1>
<p class="lead">Add to the book list below.</p>
<hr>

@include('partials.alerts.errors')

{!! Form::open([
    'route' => 'books.store',
    'files' => true
]) !!}

<div class="form-group">
    {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('user_file', 'Upload a cover image:', ['class' => 'control-label']) !!}
    {!! Form::file('user_file', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('short_description', 'Short Description:', ['class' => 'control-label']) !!}
    {!! Form::text('short_description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('long_description', 'Long Description:', ['class' => 'control-label']) !!}
    {!! Form::textarea('long_description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('ISBN10', 'ISBN-10:', ['class' => 'control-label']) !!}
    {!! Form::text('ISBN10', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('ISBN13', 'ISBN-13:', ['class' => 'control-label']) !!}
    {!! Form::text('ISBN13', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('pages', 'Pages:', ['class' => 'control-label']) !!}
    {!! Form::number('pages', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('publication_date', 'Publication Date:', ['class' => 'control-label']) !!}
    {!! Form::date('publication_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('download_url', 'Download URL:', ['class' => 'control-label']) !!}
    {!! Form::text('download_url', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('webpage_url', 'Webpage URL:', ['class' => 'control-label']) !!}
    {!! Form::text('webpage_url', null, ['class' => 'form-control']) !!}
</div>


{!! Form::submit('Create New Book', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop