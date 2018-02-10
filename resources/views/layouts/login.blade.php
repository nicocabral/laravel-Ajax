<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sounds Payment Portal</title>
	<link href="{{asset('assets/images/favicon.ico') }}" rel="shortcut icon">	
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('icons/css/fontawesome-all.min.css')}}">
    <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/loader.css')}}" rel="stylesheet" type="text/css" />
</head>
 <div class="loader">
        <span class="loader-spinner">
        <i class="fas fa-5x fa-spin fa-spinner"></i>
        </span>
    </div>
<body>
@yield('content')
 <!-- jQuery  -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/detect.js')}}"></script>
        <script src="{{asset('assets/js/fastclick.js')}}"></script>
        <script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('assets/js/waves.js')}}"></script>
        <script src="{{asset('assets/js/wow.min.js')}}"></script>
             <!-- Sweet Alert js -->
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script> 
               {{-- Validator --}}
        <script src="{{ asset('assets/validator/validator.min.js') }}"></script>
 <script type="text/javascript">
 	$(window).load(function(){
 		$('.loader').fadeOut();
 	})
 </script>
 @yield('script')
</body>
</html>