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
				    <div class="col-md-12">
				        <h3>No userprofile found.</h3>
				    </div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
@stop