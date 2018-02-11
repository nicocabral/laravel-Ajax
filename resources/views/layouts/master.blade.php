<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
   @include('includes.header')
  </head>
   <div class="loader">
        <span class="loader-spinner">
        <i class="fas fa-5x fa-spin fa-spinner"></i>
        </span>
    </div>
  <body>
    <!--navbar -->
   @include('includes.nav')
    <!-- end of navbar -->

    <div class="container">
    
    @yield('content')
     


    </div>
     <footer class="footer">
        @include('includes.footer')

      </footer>

     <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('_vendor/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('_vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('_assets/js/custom.js')}}"></script>
    {{-- dataTables --}}
    <script src="{{ asset('assets/dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dataTables/bs4/js/dataTables.bootstrap4.min.js') }}"></script>
         <!-- Sweet Alert js -->
    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script> 
        {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <script type="text/javascript">
      $(window).load(function(){
        $('.loader').fadeOut();
      })
    </script>
    @yield('script')
  </body>
</html>
