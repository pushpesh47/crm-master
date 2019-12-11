<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{csrf_token()}}">
	<link rel="icon" href="{{url('assest/images/favicon.ico')}}" type="image/ico" />

    <title>CRM! | </title>

    <!-- Bootstrap -->
    <link href="{{url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{url('assets/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{url('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{url('assets/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{url('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{url('assets/build/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/build/css/custom.css')}}" rel="stylesheet">
    <link href="{{url('assets/bower_components/sweetalert2.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    


    @yield('requirecss')
  </head>

  <body class="nav-md" >
    <div class="container body" >
      <div class="main_container">
        @yield('content')
      </div>
    </div>
    <!-- jQuery -->
    <script src="{{url('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{url('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script> -->
    <!-- FastClick -->
    <script src="{{url('assets/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{url('assets/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{url('assets/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{url('assets/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{url('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{url('assets/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{url('assets/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{url('assets/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{url('assets/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{url('assets/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{url('assets/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{url('assets/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{url('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{url('assets/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{url('assets/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{url('assets/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{url('assets/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{url('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
                setTimeout(function(){
                    $('#coverss').fadeOut(500);
                },100)
            });
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },isLocal: false
            });
        });
    </script>
    <script src="{{url('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{url('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{url('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        {{-- <script src="{{url('assets/vendors/validator/validator.js')}}"></script> --}}
    <script src="{{url('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/datatables.bootstrap.min.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{url('assets/build/js/custom.min.js')}}"></script>
    <script src="{{url('assets/bower_components/jquery.slimscroll.min.js')}}"></script>
    <script src="{{url('assets/bower_components/sweetalert2.min.js')}}"></script>
    <script src="{{url('assets/script.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    @yield('requirejs')
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#myModal').modal('show');
            $("#datepicker").datepicker({
            showOn: "button",
            buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
            buttonImageOnly: true,
            buttonText: "Select date"
            });
            $('#input_starttime').timepicker({
            // 12 or 24 hour
                twelvehour: true,
            });
        });
    </script>
    @includeIf('crm.includes.reminder_model')
  </body>
</html>
