<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MentorMe RMIT') }}</title>

    <!-- Styles -->
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
        <!-- Fonts -->
        <!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
        <link rel="stylesheet" href="../resources/assets/css/main.css" />
</head>
<body>
            @if (!Auth::guest())
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>  
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{ url('/') }}">
                        MentorMe RMIT
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a class="nav" href="{{ url('/') }}">Home</a></li>
                        <li><a class="nav" href="{{ url('/home') }}">Teach or Learn</a></li>
                        <li><a class="nav" href="{{ url('/edit') }}">Update Profile</a></li>    
                        <li><a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>                 
                </div>
            @endif
    <div id="app">
        <section id="header">
            <div class="top-right links">
                <div class="inner">
                    <!-- Authentication Links -->
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
                        <h1><strong>MentorMe RMIT</strong></h1>
                    </a>
                    <p>Let a mentor help you! Or go mentor someone!</p>
                </div>
            </div>
        </section>
    </div>

        @yield('content')
        
        <br>
        <br>
        
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
                    <li>&copy; Untitled</li><li></li>
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

    <style>
        .navbar-toggle{
            background-color: #e8e8e8;
        }

        .nav>li{
            border-bottom: 1px solid lightskyblue;
        }

        .icon-bar{
            background-color: indianred;
        }
        .log, .reg{
            padding-left: 10px;
            padding-right: 10px;
        }
        .log {
            border-right: 1px solid white;
        }
        .button-route, .nav{
            border-bottom: none;
        }

        .nav a{
            padding-top: 10px;
        }

        a {
            border-bottom: none !important; 
        }
    </style>

    <!-- Scripts -->
    <script src="{{ url('/js/app.js') }}"></script>
</body>
</html>
