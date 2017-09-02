<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>TutorMe RMIT</title>

		<!-- Fonts -->
		<!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
		<link rel="stylesheet" href="../resources/assets/css/left.css" />
</head>


<body>
		<header id="header">
			<div class="inner">
				 
				@if (Route::has('login'))
						<div id="bottom-right column">
							@if (Auth::check())
								<a href="{{ url('/home') }}">Home</a>
							@else
			                    <a class="log" href="{{ url('/login') }}">Login</a>
			                    <a class="reg" href="{{ url('/register') }}">Register</a>
							@endif
						</div>
					@endif
				
				<span class="icon major fa-cloud"></span>

				 
				@if (Auth::check())
				 <h1>Welcome to<strong>TutorMe RMIT  {{ Auth::user()->name }}!</strong><br/> </h1>
			
				@else
				<h1>Welcome to<strong>TutorMe RMIT</strong><br />
							</h1>
				@endif
				<p>Let Tutor Help You</p>
				
				<br>
				
				
					<li><a href="{{ url('/home') }}" class="button scrolly">>Home </a></li>
			
				
				<br>
			
				<li><a href="{{ url('/') }}" class="button scrolly">>match</a></li>
			
				
				<br>
		        <br>
			
				<br>


				
				
			</div>
		</header>
		
		<div id = "main">
		 @yield('content')
		</div>
		<!-- put blabla thing here -->
		
		
		
		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					
					<ul class="copyright">
						<li>&copy; Untitled</li><li>Design: </li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
				<script src="assets/js/jquery.min.js"></script>
				<script src="assets/js/jquery.scrolly.min.js"></script>
				<script src="assets/js/skel.min.js"></script>
				<script src="assets/js/util.js"></script>
								<script src="assets/js/left.js"></script>

	</body>
	</html>