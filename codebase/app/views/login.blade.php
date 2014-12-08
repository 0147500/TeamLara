@extends("layout")
@section("content")
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		
		<div class="panel panel-default">
			<div class="panel-heading">Sign in</div>
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
				
				<form role="form" method="POST" action="{{ URL::Route('handleLogin') }}">
					<div class="form-group">
						<label for="email_or_username">Username or Email</label>
				    	<input type="text" class="form-control" id="email_or_username" name="email_or_username" value="{{ Input::old('email_or_username') }}">
				    </div>
					<div class="form-group">
						<label for="password">Password</label>
				    	<input type="password" class="form-control" id="password" name="password">
				    </div>
				    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
				</form>
			</div>
		</div>
	</div>
</div>
	
@stop