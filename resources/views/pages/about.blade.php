@extends('layouts.master')

@section('page-title')
	<title>About FreeTechBooks</title>
@stop

@section('content')
	<div class="row">
		<!-- content column -->
		<div class="col-lg-8 col-md-8">
			<p class="h2">What's Inside?</p>
			<!-- <hr> -->
			<p>This site lists free online computer science, engineering and programming <strong>books</strong>, <strong>textbooks</strong> and <strong>lecture notes</strong>, all of which are legally and freely available over the Internet.</p>
			<p>Throughout this site, other terms are used to refer to a <strong>book</strong>, such as <strong>ebook</strong>, <strong>text</strong>, <strong>document</strong>, <strong>monogram</strong> or <strong>notes</strong>.</p>
			<p class="h2">What's the Catch?</p>
			<!-- <hr> -->
			<p><strong>NONE</strong>. All the books listed in this site are <strong>freely available</strong>, as they are hosted on websites that belong to the authors or the publishers.</p>
			<p>Please note that <strong>(a)</strong> we do not host pirated books and <strong>(b)</strong> we do not link to sites that host pirated books and <strong>(c)</strong> we do not even link to sites that link to sites that host pirated books.</p>
			<p>Please also note that each author and publisher has their own <strong>terms and conditions</strong> in the forms of free / open <a href="{{ route('licenses.index') }}">licenses</a>, public domain or other specific ones.</p>
			<p>You are allowed to <strong>view, download and with a very few exceptions, print</strong> the books for your own private use at <strong>no charge</strong>. In fact, you are encouraged to tell others about the books.</p>
			<p class="h2">Feedback and Suggestions</p>
			<!-- <hr> -->
			<p>Any feedback and suggestions are most welcome. Please use the <a href="{{ route('contact') }}">Contact Us</a> form. </p>
<!-- 			<p>&nbsp;</p>
			<p>Regards,</p>
			<p>Admin</p>
 -->		</div>

		<!-- side navigation column -->
		<div class="col-lg-4 col-md-4">

			@include('partials.categories.list')
			@include('partials.topics.popular')

		</div>
	</div>
@stop

@section('extra-footer')
@stop