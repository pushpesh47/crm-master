<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CRM!|</title>

    <!-- Bootstrap -->
    <link href="{{url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{url('assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{url('assets/build/css/custom.min.css')}}" rel="stylesheet">
        <link href="{{url('assets/bower_components/sweetalert2.css')}}" rel="stylesheet">

    <style type="text/css">
    .help-block{
      color: red;
    }      
    </style>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            @include('crm.includes._message')
             <form role="login" method="post" action="{{url('crm/login')}}">
              {{csrf_field()}}
              <h1>Login Form</h1>
              <div>
                <input type="text" name="email" class="form-control" placeholder="email" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" />
              </div>
              <div>
                <button type="button"  data-request="ajax-submit" data-target='[role="login"]' class="btn btn-default submit" >Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> CRM!</h1>
                  <p>©{{date('Y')}} All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" />
              </div>
              <div>
                <input type="email" name="email" class="form-control" placeholder="Email" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> CRM!</h1>
                  <p>©{{date('Y')}} All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
  <script src="{{url('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{url('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <script src="{{url('assets/bower_components/jquery.slimscroll.min.js')}}"></script>
  <script src="{{url('assets/bower_components/sweetalert2.min.js')}}"></script>
  <script src="{{url('assets/script.js')}}"></script>
</html>
