<!DOCTYPE html>
<html>
<head>
	<title>Access Denied</title>
	 <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>  
	<div class="card text-center">
  <div class="card-header">
    JACKPACK MALL
  </div>
  <div class="card-body">
    <h5 class="card-title">403 ERROR</h5>
    <img src="{{asset('403p.jpg')}}" width="800px" height="500px">
    <p class="card-text"> </p>

    		<a type="button" class="btn btn-primary" href="{{route('index')}}" >Continue</a>
  </div>
  <div class="card-footer text-muted">
    403 ERROR
  </div>
</div>

</body>
</html>