<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bill Management System">
    <meta name="keywords" content="Amit Saha, Bs amit">
    <meta name="author" content="Amit Saha">
    <link rel="icon" href="{{asset(siteSettings()->favicon)}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset(siteSettings()->favicon)}}" type="image/x-icon">
    <title>{{siteSettings()->company_name}} | Login</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/backend/vendors/themify.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/backend/vendors/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/backend/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/backend/responsive.css')}}">
  </head>
  <body>
        <div class="container-fluid p-0">
            <div class="row m-0">
              <div class="col-12 p-0">    
                <div class="login-card login-dark">
                  <div>
                    <div>
                        <a class="logo" href="{{url('/')}}">
                            <img class="img-fluid for-dark" style="height: 80px" src="{{asset(siteSettings()->company_main_logo)}}" alt="looginpage">
                            <img class="img-fluid for-light" style="height: 80px" src="{{asset(siteSettings()->company_main_logo)}}" alt="looginpage">
                        </a>
                    </div>
                    <div class="login-main"> 
                    <form class="theme-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h4 class="text-center">{{ siteSettings()->company_name}}</h4>
                        <p class="text-center">Sign in to account </p>
                        <div class="form-group">
                            <label class="col-form-label" for="email">{{ __('Email Address') }} *</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" placeholder="admin@gmail.com" name="email" value="{{old('email')}}" autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="pwd">Password*</label>
                            <div class="form-input position-relative">
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="pwd" placeholder="*********" required autocomplete="current-password">
                                <div class="show-hide"> <span class="show"></span></div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="remember" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="text-muted" for="remember"> {{ __('Remember Me') }} </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="link" href="{{ route('password.request') }}">
                                    {{ __('Reset Password?') }}
                                </a>
                            @endif
                            <div class="text-end mt-3">
                                <button class="btn btn-primary btn-block w-100" type="submit">{{ __('Sign in') }} </button>
                            </div>
                        </div>
                        <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="{{route('register-customer')}}">Create Account</a></p>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script src="{{asset('js/backend/jquery.min.js')}}"></script>
            <script src="{{asset('js/backend/bootstrap/bootstrap.bundle.min.js')}}"></script>
            <script src="{{asset('js/backend/config.js')}}"></script>
            <script src="{{asset('js/backend/script.js')}}"></script>
        </div>
    </body>
</html>