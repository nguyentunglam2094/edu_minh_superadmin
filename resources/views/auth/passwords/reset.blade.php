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
  <title>Đổi mật khẩu</title>
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
            <span class="db"><img src="{{ asset('img/logo_kiosk.png') }}" alt="logo"
                style="width:30%;height:auto" /></span>
            <h4 class="font-large m-t-20" style="padding-top:20px">Reset password</h4>
          </div>
          <!-- Form -->
          <div class="row">
            <div class="col-12">
              <form method="POST" action="{{ route('password.update') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-email"></i></span>
                  </div>
                  <input type="email" class="form-control form-control-lg @if ($errors->has('email')) is-invalid @endif"
                    value="{{ old('email') }}" placeholder="Email" name="email" aria-label="Email">
                  <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2"><i class="ti-lock"></i></span>
                  </div>
                  <input type="password"
                    class="form-control form-control-lg @if ($errors->has('password')) is-invalid @endif"
                    name="password" placeholder="New password" aria-label="Password" aria-describedby="basic-addon1">
                  <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2"><i class="ti-lock"></i></span>
                  </div>
                  <input type="password"
                    class="form-control form-control-lg @if ($errors->has('password_confirmation')) is-invalid @endif"
                    name="password_confirmation" placeholder="Confirm password" aria-label="Password"
                    aria-describedby="basic-addon1">
                  <span class="invalid-feedback"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                </div>
                <div class="row m-t-20">
                  <div class="col-12">
                    <button class="btn btn-block btn-lg btn-success" type="submit" name="action">Reset password</button>
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
            toastr.options.positionClass = 'toast-bottom-right';
            toastr.success("{{ Session::get('status') }}");
        @endif
  </script>
</body>

</html>
