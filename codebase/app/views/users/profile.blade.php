@extends("layout")
@section("content")
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		
		<div class="panel panel-default">
			<div class="panel-heading">User Profile</div>
			<div class="panel-body">
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
				<div class="row">
					<div class="col-md-6">
						<h5>Username:</h5>
					</div>
					<div class="col-md-6">
						<h6>{{ $user->username }}</h6>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<h5>Score:</h5>
					</div>
					<div class="col-md-6">
						<h6>{{ $user->score }}</h6>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<h5>Rank:</h5>
					</div>
					<div class="col-md-6">
						<h6>{{ $user->rank }}</h6>
					</div>
				</div>
			</div>
		</div>
		@if($user->username == Auth::user()->username)
		<div class="panel panel-default">
			<div class="panel-heading">User Profile</div>
			<div class="panel-body">
				<form role="form" method="POST" action="{{ URL::route('handleUpdate',$user->username)}}">
					<div class="form-group">
					    <div class="row">
					    	<div class="col-xs-5">
				        		<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="{{ $user->first_name }}">		    	
					    	</div>
					    	<div class="col-xs-7">
					        	<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" value="{{ $user->last_name }}">
					    	</div>
					    </div>
					</div>
					<div class="form-group">
				    	<input type="email" class="form-control" id="email" name="email" placeholder="Your email" value="{{ $user->email }}">
				    </div>
					<div class="form-group">
				    	<input type="password" class="form-control" id="password" name="password" placeholder="Choose a password">
				    </div>
					<div class="form-group">
				    	<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm the password">
				    </div>
				    <button type="submit" class="btn btn-primary btn-lg btn-block">Update profile</button>
				</form>
			</div>
		</div>
		@endif
	</div>
</div>
	
@stop