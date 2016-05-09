@extends('layouts.master')

@section('page-title')
    <title>Add a New Sub-Category</title>
@stop

@section('extra-header')
    <!-- select2 -->
    <link rel="stylesheet" type="text/css" href="/bower_components/select2/dist/css/select2.min.css">
@stop

@section('content')

<h1>Add a New Sub-Category</h1>
<hr>

@include('partials.alerts.errors')

{!! Form::open([
    'route' => 'forums.store',
    'files' => true
]) !!}

@include('partials.forums.edit')

{!! Form::submit('Add New Sub-Category', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop

@section('extra-footer')

@include('partials.forums.select2')

@endsection
