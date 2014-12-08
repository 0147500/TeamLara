<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TeamLara</title>

        {{ HTML::style('vendor/yellow-text/css/yellow-text-default.css') }}

        {{ HTML::style('vendor/bootstrap/bootstrap.min.css') }}
        {{ HTML::style('vendor/bootstrap/bootstrap-theme.min.css') }}
	
        {{ HTML::style('css/style.css') }}
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css" />
        
        @yield("styles")
        @yield("header-links")
	
</head>
<body>
	<div id="main-container" class="container">
		@include("header")
		
		<div class="row">
			<div class="col-md-12">
				@yield("content")
			</div>
		</div>
		
	</div>
	
	{{ HTML::script('vendor/jquery/jquery-1.11.1.min.js') }}
	{{ HTML::script('vendor/bootstrap/bootstrap.min.js') }}
	{{ HTML::script('vendor/yellow-text/yellow-text.min.js') }}
	
	<script>
		$(function() {
  			$("#new-challenge-body-editor").YellowText();
		})
	</script>
	
	@yield("footer-links")
	
</body>
</html>
