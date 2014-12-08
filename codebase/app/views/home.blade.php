@extends("layout")
@section("content")
<div class="row">
	<div id="home-left" class="col-md-8">
		<h1>Learn programming the right way!.</h1>
		<ul>
			<li>Solve programming challenges</li>
			<li>Receive feedback with tips and advice</li>
			<li>Discuss challenges and solutions with other users</li>
			<li>Review submitted solutions</li>
		</ul>
		<h4>
			Are you new to programming and don't know where to start?
			Have you been crafting software for a few years but want to test and improve your skills? 
			Are you a programming guru and and want to share your knowledge with the community?
		</h4>
		<h3>You have come to the right place! What are you waiting for? Sign up now!</h3>
	</div>
	<div id="home-right" class="col-md-4">
		@if (Session::has('message'))
			<div class="alert {{ Session::get('alert-class') }}" role="alert">
				{{ Session::get('message') }}
			</div>
		@endif
		
		@if (Session::has('errors'))
			<div class="alert alert-danger" role="alert">
				{{ $errors->first() }}
			</div>
		@endif	
		<form role="form" method="POST" action="{{ URL::route('handleSignup')}}">
			<div class="form-group">
			    <div class="row">
			    	<div class="col-xs-5">
		        		<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="{{ Input::old('first_name') }}">		    	
			    	</div>
			    	<div class="col-xs-7">
			        	<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" value="{{ Input::old('last_name') }}">
			    	</div>
			    </div>
			</div>
			<div class="form-group">
		        <input type="text" class="form-control" id="username" name="username" placeholder="Pick a username" value="{{ Input::old('username') }}">
			</div>
			<div class="form-group">
		    	<input type="email" class="form-control" id="email" name="email" placeholder="Your email" value="{{ Input::old('email') }}">
		    </div>
			<div class="form-group">
		    	<input type="password" class="form-control" id="password" name="password" placeholder="Choose a password">
		    </div>
			<div class="form-group">
		    	<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm the password">
		    </div>
		    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign up</button>
		</form>
	</div>
</div>
@stop