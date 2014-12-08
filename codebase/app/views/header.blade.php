@section("header")
    <nav class="navbar navbar-inverse navbar-main navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::route('home') }}">TeamLara</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
          <ul class="nav navbar-nav main-navbar-pages">
            @if(Auth::check())
            <li><a href="{{ URL::route('showUserProfile', Auth::user()->username) }}">My Profile</a></li>
            @endif
            <li><a href="{{ URL::route('challenges') }}">Challenges</a></li>
            <li><a href="{{ URL::route('about') }}">About</a></li>
          </ul>
            <div class="navbar-text navbar-right">
                @if (Auth::check())
                    Signed in as <b>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</b>
                    (<a href="{{ URL::route('handleLogout') }}">Logout</a>)
                @else
                    <a href="{{ URL::route('showLogin') }}">Login</a><br />
                @endif
            </div>
        </div>
      </div>
    </nav>
@show