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
   <div style="height: 50px"></div>

    @yield('content')
</body>
</html>
