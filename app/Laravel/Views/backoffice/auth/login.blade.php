<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{asset('backoffice/assets/img/logo-fav.png')}}">
    <title>Login :: {{env('APP_TITLE','Localhost')}} Admin</title>
    <link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/material-design-icons/css/material-design-iconic-font.min.css')}}"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
<![endif]-->
<link rel="stylesheet" href="{{asset('backoffice/assets/css/style.css')}}" type="text/css"/>
</head>
<body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading">
                    <img src="{{asset('backoffice/assets/face0.jpg')}}" alt="" class="img-circle" width="150">
                    {{-- <img src="{{asset('backoffice/assets/img/logo-xx.png')}}" alt="logo" width="102" height="27" class="logo-img"> --}}
                    <span class="splash-description">
                    Please enter your user information.</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        @include('backoffice._components.notification')
                    </div>
                    <form action="" class="form-horizontal" method="post">
                        <input type="hidden" name="_token" value={{csrf_token()}}>
                        <div class="form-group">
                            <input id="username" name="username" type="text" placeholder="Username" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" name="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group row login-tools">
                            <div class="col-xs-6 login-remember">
                              <div class="be-checkbox">
                                <input type="checkbox" id="remember" name="remember_me">
                                <label for="remember">Remember Me</label>
                            </div>
                        </div>
                        {{-- <div class="col-xs-6 login-forgot-password"><a href="#">Forgot Password?</a></div> --}}
                    </div>
                    <div class="form-group login-submit">
                        <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Sign me in</button>
                    </div>
                    </form>
                </div>
            </div>
        {{-- <div class="splash-footer"><span>Don't have an account? <a href="#">Sign Up</a></span></div> --}}
    </div>
</div>
</div>
</div>
<script src="{{asset('backoffice/assets/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/js/main.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
        //initialize the javascript
        App.init();
    });

</script>
</body>
</html>