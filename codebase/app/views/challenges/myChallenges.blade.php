@extends("layout")
@section("content")
<div class="row">
	<div class="col-md-12">
		<div>
			<h1>My challenges</h1>
			<a href="{{ Route('create-challenge') }}" class="btn btn-primary">New challenge</a>
		</div>
		<div class="list-group">
			@foreach ($challenges as $challenge)
		    <div class="list-group-item">
		        <div class="list-group-item-heading clearfix">
		            <span class="pull-left">
		            	<h2><a href="{{Route('challenge', array($challenge->id))}}">{{$challenge->name}}</a></h2>
		            	<p>{{$challenge->description}}</p>
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
		            	Created at {{$challenge->created_at}} by {{$challenge->user->username}}
		            </div>
		        </div>
		    </div>
			@endforeach
		</div>
	</div>
</div>
	
@stop