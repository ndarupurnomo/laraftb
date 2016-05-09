<nav class="navbar navbar-default">
  <div class="container">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('front') }}">FreeTechBooks</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
<!-- 
        <li><a href="{{ route('categories.index') }}">Browse Categories</a></li>
        <li><a href="{{ route('authors.index') }}">Authors</a></li>
        <li><a href="{{ route('publishers.index') }}">Publishers</a></li>
        <li><a href="{{ route('licenses.index') }}">Licenses</a></li>
 -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Browse Books <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('topics.index') }}">All Books</a></li>
            <li><a href="{{ route('categories.index') }}">By Category</a></li>
            <li><a href="{{ route('authors.index') }}">By Author</a></li>
            <li><a href="{{ route('publishers.index') }}">By Publisher</a></li>
            <li><a href="{{ route('licenses.index') }}">By License</a></li>
          </ul>
        </li>
        <li><a href="http://feeds.feedburner.com/freetechbooks"><i class="fa fa-rss fa-lg"></i></a></li>
        <li><a href="https://twitter.com/freetechbooks2"><i class="fa fa-twitter fa-lg"></i></a></li>
        <!-- <li><a href="facebook"><i class="fa fa-facebook fa-lg"></i></a></li> -->
        <li><a href="{{ route('contact') }}"><i class="fa fa-envelope fa-lg"></i></a></li>
        <!-- <li><a href="{{ route('about') }}">About</a></li> -->
        <!-- <li><a href="{{ route('contact') }}">Contact</a></li> -->
      </ul>

      <ul class="nav navbar-nav navbar-right">

          {{-- @include('partials.topics.searchnav') --}}

          {{-- @include('partials.google.cse') --}}

          @unless (Auth::guest())
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ route('categories.create') }}">+Category</a></li>
                  <li><a href="{{ route('forums.create') }}">+Sub Category</a></li>
                  <li><a href="{{ route('topics.create') }}">+Book</a></li>
                  <li><a href="{{ route('authors.create') }}">+Author</a></li>
                  <li><a href="{{ route('publishers.create') }}">+Publisher</a></li>
                  <li><a href="{{ route('licenses.create') }}">+License</a></li>
                  <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
              </ul>
          </li>
          @endunless        
      </ul>
    </div>

  </div>
</nav>