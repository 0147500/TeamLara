@extends("layout")
@section("content")
<style>
	/*.nav-tabs > #Challenge-tab{
		background-color: blue;
	}*/
	 	
    .solution{
    	height:100px;
    }
</style>
<script>
	var solutions = [];
</script>
<div class="row">
	<div class="col-md-12">
		<h1>{{ $challenge->name }} <small>@if ($challenge->difficulty == 1)
					    		<span class="label label-success pull-right">Easy</span>
				           	@elseif ($challenge->difficulty == 2)
				            	<span class="label label-warning pull-right">Medium</span>
				        	@elseif ($challenge->difficulty == 3)
				            	<span class="label label-danger pull-right">Hard</span>
				            @endif</small></h1>
		<hr>
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
		<div role="tabpanel">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" id="Challenge-tab" class="active">
					<a href="#Challenge" role="tab" data-toggle="tab" aria-controls="Challenge">
						Challenge	
					</a>
				</li>
				<li role="presentation" id="Discussion-tab" class="tab-default">
					<a href="#Discussion" role="tab" data-toggle="tab" aria-controls="Discussion">
						Discussion	
					</a>
				</li>
					@if (!empty($userSolution->reviewed_by) || ($challenge->created_by == Auth::user()->id))
					<li role="presentation" id="Solution-tab">
						<a href="#Solutions" role="tab" data-toggle="tab" aria-controls="Solutions">
							Solutions
						</a>
					</li>
					<li role="presentation" id="Pending-solution-tab">
						<a href="#Pending-solutions" role="tab" data-toggle="tab" aria-controls="Pending-solutions">
							Pending Solutions	
						</a>
					</li>
					@endif
				
			</ul>
			
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="Challenge">
						<div class="panel panel-default">
							<div class="panel-heading">
								{{{ $challenge->description }}}
							</div>
							<div class="panel-body">
								
								{{ $challenge->body }}
								<span class="label label-default pull-right">{{$challenge->created_at}}</span>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								My Solution:
								@if (!empty($userSolution->reviewed_by)) 
									<a href="{{ Route('delete-solution', array($userSolution->id)) }}" class="btn btn-danger btn-xs pull-right">Remove solution</a>
								@endif
							</div>
							<div class="panel-body">
								@if (!empty($userSolution->reviewed_by))
									<div><h4>Marked as correct by {{$userSolution->reviewedBy->profileLink()}} on {{ $userSolution->reviewed_at }}</h4></div><br />
									<div id="editor" class="solution">{{{$userSolution->body}}}</div>
								@else
									<form method="post" action="{{ Route('solution',$challenge->id) }}">
									<div style="height:100px;" id="editor"></div>
									
									<textarea id="solution-body" name="body" style="display:none;"></textarea>
									<button id="btnSubmitSolution" class="btn btn-default btn-lg pull-right">Submit Solution</button>
									</form>
								@endif
							</div>
						</div>
					</div>
					

					<div role="tabpanel" class="tab-pane" id="Discussion">
						
						<div class="panel panel-primary">
						@forelse($comments as $comment)
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-8">
											{{{$comment->body}}}
										</div>
										<div class="col-md-4">
											<div class="pull-right">
		            							commented at {{$comment->created_at}} by {{$comment->user->profileLink()}}
		            						</div>
										</div>
									</div>
								</div>
							</div>
						@empty
							<div class="alert alert-info ctm-alert-info">There is no comment yet. Be the first to comment!</div>
						@endforelse()
						@if (!empty($userSolution->reviewed_by) || ($challenge->created_by == Auth::user()->id))
							<div class="panel-heading">Leave a comment:</div>
							<div class="panel-body">
								<form method="post" action="{{ Route('create-challenge-comment',$challenge->id) }}">
								<textarea class="form-control" name="body" rows="4"></textarea><br>
								<input type="submit" class="btn btn-primary btn-lg pull-right" value="Send">
								</form>
							</div>
						@endif
						</div>
					</div>
					
					@if (!empty($userSolution->reviewed_by) || ($challenge->created_by == Auth::user()->id))
					
					<div role="tabpanel" class="tab-pane" id="Solutions">
						@forelse($challenge->solutions()->where('reviewed_by', '!=', 'NULL')->get() as $solution)
						<div class="panel panel-default">
								<div class="panel-heading">
									solution created by <b>{{$solution->user->profileLink()}}</b> at {{$solution->user->created_at}} and is reviewed by <b>{{ $solution->reviewedBy->profileLink() }}</b>
								</div>
							<div class="panel-body">
								<div id="solution-{{$solution->id}}" class="solution">{{{$solution->body}}}</div>
								<script>
									solutions.push({'id' : 'solution-{{$solution->id}}', 'language' : 'javascript'});
								</script>
							@forelse($solution->comments as $comment)
								<div class="panel panel-default">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-8">
											{{{$comment->body}}}
										</div>
										<div class="col-md-4">
											<div class="pull-right">
		            							commented at {{$comment->created_at}} by <b>{{$comment->user->profileLink()}}</b>
		            						</div>
										</div>
									</div>
								</div>
							</div>
							@empty()
								<div class="alert alert-info ctm-alert-info">There is no comment yet. Be the first to comment!</div>
							@endforelse()
								<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
								 Leave a comment
								</button>
								
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								        <h4 class="modal-title" id="myModalLabel">Leave a comment</h4>
								      </div>
								      <form method="post" action="{{ Route('create-solution-comment',$solution->id) }}">
								      <div class="modal-body">
								      		<textarea class="form-control" name="body" rows="4"></textarea><br>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Close</button>
								        <input type="submit" class="btn btn-primary btn-lg pull-right" value="Send">
								      </div>
								      </form>
								    </div>
								  </div>
								</div>
							</div>
							
						</div>
						@empty
							<div class="alert alert-info">This challenge has not been solved yet. Be the first to solve it!</div>
						@endforelse()
					</div>

					<div role="tabpanel" class="tab-pane" id="Pending-solutions">
						
						@forelse($challenge->solutions()->where('correct', '=', '')->get() as $solution)
						<div class="panel panel-default">
								<div class="panel-heading">
									solution created by <b>{{$solution->user->profileLink()}}</b> at {{$solution->user->created_at}}
								</div>
							<div class="panel-body">
								By {{$solution->user->profileLink()}} at {{$solution->user->created_at}}
								<div id="pending-{{$solution->id}}" class="solution">{{{$solution->body}}}</div>
								<script>
									console.log(solutions);
									solutions.push({'id' : 'pending-{{$solution->id}}', 'language' : 'javascript'});
								</script>
								<div class="pull-right">
									<a href="{{ URL::Route('mark-solution', array($solution->id)) }}" class="btn btn-success btn-xs pull-right">Mark as correct</a>
								</div>
							</div>
						</div>
						@empty
							<div class="alert alert-info">There are no pending solutions!</div>
						@endforelse()
					</div>
					@else()
					
					@endif
				
				</div>
		</div>
		
		
	</div>
</div>
@stop
@section('footer-links')
{{ HTML::script('vendor/ace/ace.js') }}
{{ HTML::script('js/ace-config.js') }}
@if (empty($userSolution))
<script>
	var textarea = $('textarea[id="solution-body"]').hide();
	editor.getSession().setValue(textarea.val());
	editor.getSession().on('change', function(){
	  textarea.val(editor.getSession().getValue());
	});
</script>
@else
<script>
	editor.setReadOnly(true);
	solutions.forEach(function(item){ 
		var ed = configureEditor(item.id, item.language);
		ed.setReadOnly(true);
	});
</script>
@endif
@stop