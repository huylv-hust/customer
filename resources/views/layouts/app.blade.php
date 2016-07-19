<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

	<script src="{{asset('js/jquery.js')}}"></script>
	<script src="{{asset('js/select2.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{asset('js/home.js')}}"></script>

	<link href="{{asset('css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
	<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
	<link href="{{asset('css/home.css')}}" rel="stylesheet">

    <script>
        var baseUrl = '<?php echo url('/') ?>';
    </script>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


                <a class="navbar-brand" href="">
                    USAMI
                </a>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Administrative units <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('list_city')}}">City</a></li>
                            <li><a href="{{route('list_district')}}">District</a></li>
                            <li><a href="{{route('list_town')}}">Town</a></li>
                            <li><a href="#">Import CSV</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Customer <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('list_customers')}}">List</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @if ($user = Session::get('user'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ $user['user'] }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</body>
</html>
