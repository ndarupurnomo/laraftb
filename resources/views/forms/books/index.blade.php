@extends('layouts.master')

@section('content')

<h1>Book List</h1>
<p class="lead">Here's a list of all books. <a href="{{ route('books.create') }}">Add a new one?</a></p>
<hr>

@foreach($books as $book)
    <h3>{{ $book->title }}</h3>
    <p>{{ $book->short_description}}</p>
    <p>
        <a href="{{ route('slug', ['slug' => $book->slug . '-b' . $book->id . '.html']) }}" class="btn btn-info">View Book</a>
        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit Book</a>
    </p>
    <hr>
@endforeach

@stop