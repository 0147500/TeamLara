@extends("layout")
@section("content")
<div class="row">
	<div class="col-md-12">
		<div>
			<h1>Challenges</h1>
			<a href="{{ Route('create-challenge') }}" class="btn btn-primary">New challenge</a>
			<a href="{{ Route('my-challenges') }}" class="btn btn-primary">my challenges</a>
		</div>
		<br />
		
		@if (Session::has('message'))
			<div class="alert {{ Session::get('alert-class') }}" role="alert">
				{{ Session::get('message') }}
			</div>
		@endif		
		
		<div class="list-group">
			@foreach ($challenges as $challenge)
		    <div class="list-group-item">
		    	<div class="row">
		    		<div class="col-sm-1 rating-div">
		    			<a href="{{ URL::Route('vote-up-challenge', $challenge->id) }}"><i class="fa fa-arrow-up"></i></a>
		    			<h1>{{ $challenge->rating }}</h1>
		    			<a href="{{ URL::Route('vote-down-challenge', $challenge->id) }}"><i class="fa fa-arrow-down"></i></a>
		    		</div>
		    		<div class="col-sm-11">
				        <div class="list-group-item-heading clearfix">
				            <span class="pull-left">
				            	<h2><a href="{{Route('challenge', array($challenge->id))}}">{{$challenge->name}}</a></h2>
				            	<p>{{{$challenge->description}}}</p>
				            </span>
				            <span class="pull-right">Difficulty: 
				            @if ($challenge->difficulty == 1)
				            	<div class="label label-success">Easy</div>
				            @elseif ($challenge->difficulty == 2)
				            	<div class="label label-warning">Medium</div>
				            @elseif ($challenge->difficulty == 3)
				            	<div class="label label-danger">Hard</div>
				            @endif
				            </span>
				        </div>
				        <div class="list-group-item-text clearfix">
				            <div class="pull-right">
				            	Created at {{$challenge->created_at}} by {{$challenge->user->profileLink()}}
				            </div>
				        </div>
					</div>
		    	</div>
		    </div>
			@endforeach
		</div>
		{{ $challenges->links() }}
	</div>
</div>
	
@stop