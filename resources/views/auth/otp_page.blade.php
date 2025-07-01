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
    <title>OTP Verify | {{siteSettings()->company_name}}</title>
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
                    <form class="theme-form" method="POST" action="{{ route('verify-customer-otp') }}">
                        @csrf
                        <h4 class="text-center">{{ siteSettings()->company_name}}</h4>
                        @if ($otp)
                            <p class="text-center">OT IS : {{$otp}}</p>
                        @endif
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$id}}">
                            <label class="col-form-label" for="otp">{{ __('Enter Your 6 Digit OTP') }} *</label>
                            <input class="form-control @error('otp') is-invalid @enderror" type="number" id="otp" min="6" placeholder="Enter OTP" name="otp" value="{{old('otp')}}" autocomplete="otp" autofocus>
                            @error('otp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <a class="link" href="{{ route('password.request') }}">
                                    {{ __('Resend OTP') }}
                                </a>
                            </div>
                            
                            <div class="text-end mt-3">
                                <button class="btn btn-primary btn-block w-100" type="submit">{{ __('Verify') }} </button>
                            </div>
                        </div>
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
