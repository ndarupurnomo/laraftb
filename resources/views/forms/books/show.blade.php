@extends('layouts.master')

@section('content')

<h1>{{ $book->title }}</h1>
<p class="lead">{{ $book->short_description }}</p>
<hr>

<a href="{{ route('books.index') }}" class="btn btn-info">Back to all books</a>
<a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit Book</a>

<div class="pull-right">
        {!! Form::open([
            'method' => 'DELETE',
            'route' => ['books.destroy', $book->id]
        ]) !!}
        {!! Form::submit('Delete this book?', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
</div>

@stop