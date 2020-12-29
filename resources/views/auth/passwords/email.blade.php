<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon_logo.png.png') }}">
  <title>Quên mật khẩu</title>
  <!-- Custom CSS -->
  <link href="{{ asset('xtreme/dist/css/style.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/login.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
      style="background:url({{ asset('xtreme/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
      <div class="auth-box">
        <div id="loginform">
          <div class="logo">
            <span class="db"><img src="{{ asset('img/logo_kiosk.png') }}" alt="logo" /></span>
            <h5 class="font-medium mt-3 mb-1">Forgot password</h5>
            <p style="font-size:13px;">Url forgot password will send by your mail!</p>
          </div>
          <!-- Form -->
          <div class="row">
            <div class="col-12">
              <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                @if(empty(Session::get('status')))
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-email"></i></span>
                  </div>
                  <input type="email" class="form-control form-control-lg @if ($errors->has('email')) is-invalid @endif"
                    value="{{ old('email') }}" placeholder="Email" name="email" aria-label="Email">
                  <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                </div>
                @else
                <span class="text-success"><strong> {{ Session::get('status') }}</strong></span>
                @endif
                <div class="row m-t-20">
                  <div class="col-12">
                    <button class="btn btn-block btn-lg btn-success" type="submit" name="action">Send Email</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- All Required js -->
  <!-- ============================================================== -->
  <script src="{{ asset('xtreme/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="{{ asset('xtreme/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
  <script src="{{ asset('xtreme/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
  <!-- ============================================================== -->
  <!-- This page plugin js -->
  <!-- ============================================================== -->
  <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
  </script>
  <script>
    @if(Session::has('status'))
    toastr.success("{{ Session::get('status') }}");
    @endif
  </script>
</body>

</html>
