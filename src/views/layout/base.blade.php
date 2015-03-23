<?php use Jsehersan\Social\Helper; ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<!-- Latest compiled and minified JS -->
<script src="//code.jquery.com/jquery.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script type="text/javascript">
  url_aj="{{URL::to('social/aj/')}}";
</script>
@section('head')
<link rel="stylesheet" href="{{Helper::asset('css/style.css')}}">
@show
</head>
<body>
	<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li ><a href="{{URL::to('social/config')}}">Home</a></li>
              <li><a href="{{URL::to('social/channels')}}">Clannels</a></li>
              
              
           
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
	<div class="container">
		@include('social::mensajes')
		<div class="row">
			<div class="page-header">
			  <h1>Laravel Social <small>publicador</small></h1>
			</div>
			@yield('main')
		</div>
	</div>
  @section('js')
  <script src="{{Helper::asset('js/scripts.js')}}"></script>
  @show
</body>
</html>