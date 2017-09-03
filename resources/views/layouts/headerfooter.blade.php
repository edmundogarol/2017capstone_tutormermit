

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>TutorMe RMIT</title>

		<!-- Fonts -->
		<!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
		<link rel="stylesheet" href="../resources/assets/css/main.css" />
</head>


<body>
		<section id="headerlog">
			<div class="inner">
			 
			@if (Route::has('login'))
					<div id="top-right">
						@if (Auth::check())
							<a href="{{ url('/home') }}">Home</a>
						@else
							<a href="{{ url('/login') }}">Login</a>&nbsp&nbsp
							<a href="{{ url('/register') }}">Register</a>
						@endif
					</div>
				@endif

				
				
				
				
				<span class="icon major fa-cloud"></span>

				 
				@if (Auth::check())
				 <h1>Welcome to<strong>TutorMe RMIT  {{ Auth::user()->name }}!</strong><br /> </h1>
			
				@else
				<h1>Welcome to<strong>TutorMe RMIT</strong><br />
							</h1>
				@endif
				<p>Let Tutor Help You</p>
				
				
			</div>
		</section>
		
		
		
		
		
		 @yield('content')
		
		<!-- put blabla thing here -->
		
		
		
		
		
		
		
		<!-- Footer -->
			<section id="footer">
				<ul class="icons">
					<li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
					<li><a href="#" class="icon alt fa-envelope"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
				</ul>
			</section>

		<!-- Scripts -->
				<script src="assets/js/jquery.min.js"></script>
				<script src="assets/js/jquery.scrolly.min.js"></script>
				<script src="assets/js/skel.min.js"></script>
				<script src="assets/js/util.js"></script>
				<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
				<script src="assets/js/main.js"></script>

	</body>
	</html>