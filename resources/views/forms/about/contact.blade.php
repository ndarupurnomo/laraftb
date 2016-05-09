@extends('layouts.master')

@section('page-title')
	<title>Contact Us</title>
	<meta name="description" lang="en" content="Use this contact form to send us feedback, inquiry and/or suggestions.">
@stop

@section('pre-content')
@stop

@section('content')

<p class="h1">Contact FreeTechBooks</p>

<p class="lead">Please use this contact form to send us feedback, inquiry and/or suggestions.</p>
<hr>

@include('partials.alerts.errors')

{!! Form::open(array('route' => 'contact_store', 'class' => 'form')) !!}

@include('partials.about.edit')

{!! Form::submit('Contact Us!', array('class'=>'btn btn-primary')) !!}

{!! Form::close() !!}

@stop

@section('extra-footer')
@stop
