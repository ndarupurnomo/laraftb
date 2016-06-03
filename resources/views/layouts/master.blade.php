<!doctype html>
<html lang="en">
<head>

  @yield('page-title')

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- <link rel="alternate" type="application/rss+xml" href="{{ url('rss') }}" title="RSS Feed FreeTechBooks"> -->
  <link rel="alternate" lang="en" type="application/rss+xml" href="{{ url('rss') }}" title="RSS Feed FreeTechBooks">

  <!-- Latest compiled and minified CSS -->
  <!-- Bootstrap: sandstone, spacelab, united --> 
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.yeti.css">
  <!-- Optional theme -->
  <!-- <link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.min.css"> -->
  <!-- Submenu Bootstrap -->
  <!-- <link rel="stylesheet" href="/css/bootstrap-submenu.min.css">   -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Custom Bootstrap -->
  <link rel="stylesheet" type="text/css" href="/css/custom.css">
  <!-- Custom BBCode CSS -->
  <link rel="stylesheet" type="text/css" href="/css/bbcode.css">  

  @yield('extra-header')

  <!-- Latest compiled and minified JS -->
  <!-- respond.js -->
  <script type="text/javascript" src="/js/respond.min.js"></script>

  <!-- Latest compiled and minified JavaScript -->
  <!-- jQuery -->
  <script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Submenu Bootstrap -->

  <script type="text/javascript">
  yuhuads="http://track.yuhuads.com/interstitial/573060d2ed6ef6df1ccef924/"+((new Date()).getTime()) + Math.random();
  document.write("<scr"+"ipt language='javascript' type='text/javascript' src='"+yuhuads+"'></scri"+"pt>");
  </script>

</head>
<body>

  @yield('pre-body')

  @include('partials.nav')

  @yield('pre-content')

  <div class="container">
      @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
      @endif

      @yield('content')
  </div>

  <hr>

  @include('partials.footer')

  @include('partials.tracker.googleanalytics')

  @yield('extra-footer')

</body>
</html>