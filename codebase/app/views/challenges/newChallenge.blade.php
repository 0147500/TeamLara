@extends("layout")
@section("content")
<div class="row">
    <div class="col-md-12">
        <h1>New Challenge</h1>
        @if (Session::has('errors'))
    		<div class="alert alert-danger" role="alert">
    			{{ $errors->first() }}
    		</div>
		@endif
        <hr/>
        <form role="form" method="post" action="{{ URL::Route('create-challenge') }}">
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" name="name"/>
            </div>
            <div class="form-group">
                <label for="description">Short Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="body">Challenge</label>
                <textarea rows="15" id="new-challenge-body-editor" name="body" class="form-control"></textarea>
            </div>
                <br /><label for="difficult">Choose Difficulty:</label><br />
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-success"><input type="radio" name="difficulty" value="1" autocomplete="off">Easy</label>
                <label class="btn btn-warning"><input type="radio" name="difficulty" value="2" autocomplete="off">Medium</label>
                <label class="btn btn-danger"><input type="radio" name="difficulty" value="3" autocomplete="off">Hard</label>
                
            </div>
            <div class="form-group">
                <br>
                <button type="submit" class="btn btn-default btn-lg">Create</button>
            </div>
        </form>
    </div>
</div>
</head>

@stop