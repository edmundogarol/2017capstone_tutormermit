<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>MentorMe RMIT</title>

		<!-- Fonts -->
		<!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
		<link rel="stylesheet" href="../resources/assets/css/left.css" />
</head>


<body>

		<header id="header">
			<div class="inner">
				 
				@if (Auth::guest())
					<a class="log" href="{{ url('/login') }}">Login</a>
					<a class="reg" href="{{ url('/register') }}">Register</a>
				@else
					<div class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>
					</div>
				@endif

				<a href="{{ url('/') }}">
					<h1><strong>TutorMe RMIT</strong></h1>
				</a>
				
				
				<p>Let a tutor help you! Or go tutor someone!</p>

				
				<br>
				
				 @if (!Auth::guest())
					<div class="collapse navbar-collapse" id="app-navbar-collapse">
							<!-- Left Side Of Navbar -->
							<ul>
								
								<li><a href="{{ url('/') }}" class="">>Home </a></li>
								<br>

								<li><a class="" href="{{ url('/home') }}">>Teach or Learn</a></li>
								<br>
								<li><a class="" href="{{ url('/edit') }}">>Update Profile</a></li>  
								<br>  
								<li><a class="" href="{{ url('/logout') }}"
										onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
										>Logout
									</a>

									<form class="button scrolly" id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>
							</ul>                 
						</div>
					@endif
					
					


				
				
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