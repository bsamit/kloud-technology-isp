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
    <title>{{siteSettings()->company_name}} | Register</title>
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
                    <form class="theme-form" method="POST" action="{{ route('register-customer-store') }}">
                        @csrf
                        <h4 class="text-center">{{ siteSettings()->company_name}}</h4>
                        <p class="text-center">Register as an Potential Customer</p>
                        <div class="form-group">
                            <label class="col-form-label" for="name">{{ __('Name') }} *</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" placeholder="Customer Name" name="name" value="{{old('name')}}" autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

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
                            <label class="col-form-label" for="email">{{ __('Mobile') }} *</label>
                            <input class="form-control @error('mobile') is-invalid @enderror" type="mobile" id="mobile" placeholder="01700000000" name="mobile" value="{{old('mobile')}}" autocomplete="mobile" autofocus>
                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="email">{{ __('Address') }} *</label>
                            <input class="form-control @error('address') is-invalid @enderror" type="address" id="address" placeholder="City, District, Post Code" name="address" value="{{old('address')}}" autocomplete="address" autofocus>
                            @error('address')
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

                        <div class="form-group">
                            <label class="col-form-label" for="password_confirmation">Confirm Password*</label>
                            <div class="form-input position-relative">
                                <input class="form-control @error('password_confirmation') is-invalid @enderror" 
                                       type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       placeholder="*********" 
                                       required>
                                <div class="show-hide">
                                    <span class="show"></span>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-0">
                            <div class="text-end mt-3">
                                <button class="btn btn-primary btn-block w-100" type="submit">{{ __('Register') }} </button>
                            </div>
                        </div>
                        <p class="mt-4 mb-0">Already have an account?<a class="ms-2" href="{{route('login')}}">Sign in</a></p>
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
