
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset(siteSettings()->favicon)}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset(siteSettings()->favicon)}}" type="image/x-icon">
    <title>@yield('title') | {{ siteSettings()->company_name }} </title>
    <link rel="stylesheet" href="{{asset('include/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('include/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('include/css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Averia+Sans+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>

    <section class="">
        <nav class="navbar navbar-expand-lg navbar-light kloud_header">
          <div class="container">
            <a class="navbar-brand kloud_head_logo" href="{{url('/')}}"><img src="./include/img/kloud-logo.png" class="img-fluid" alt="img"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end header_menu_list" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link {{request()->is('/') ? 'active' : ''}}" aria-current="page" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{request()->is('about-us') ? 'active' : ''}}" href="{{route('about-us')}}">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{request()->is('services') ? 'active' : ''}}" href="{{route('services')}}">Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{request()->is('package') ? 'active' : ''}}" href="{{route('package')}}">Package</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{request()->is('solution') ? 'active' : ''}}" href="{{route('solution')}}">Solutions</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{request()->is('contact') ? 'active' : ''}}" href="{{route('contact')}}">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </section>
    @yield('site_content')

    <footer class="footer">
        <div class="container-fluid">
            <div class="row footer_main">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="footer_logo">
                       <img src="./include/img/kloud-logo.png" class="img-fluid" alt="img">
                        <div class="footet_social_link">
                        <ul>
                            <li><a href=""><i class="fa-brands fa-square-facebook"></i></a></li>
                            <li><a href=""><i class="fa-brands fa-square-whatsapp"></i></a></li>
                            <li><a href=""><i class="fa-brands fa-youtube"></i></a></li>
                            <li><a href=""><i class="fa-brands fa-linkedin"></i></a></li>
                            <li><a href=""><i class="fa-brands fa-square-twitter"></i></a></li>
                        </ul>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="footet_quick_link">
                        <h6>Get in touch</h6>
                        <ul>
                            <li><i class="fa-solid fa-location-dot footer_icon"></i> <span>Shanta Western Tower, Suit # 904, Level 9, 186 Bir Uttam<br>
                              Mir Sawkat Road, Tejgaon I/A, Dhaka – 1208, Bangladesh.</span></li>
                            <li><i class="fa-solid fa-phone footer_icon"></i> <span>+8809649161215</span></li>
                            <li><i class="fa-solid fa-envelope footer_icon"></i> <span>contact@kloud.com.bd</span></li>
                           
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="footet_quick_link">
                        <h6>Property Cities</h6>
                        <ul>
                            <li><a href="">Home</a></li>
                            <li><a href="">About Me</a></li>
                            <li><a href="">All Art Works</a></li>
                            <li><a href="">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="footet_quick_link">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="">Browe all Categories</a></li>
                            <li><a href="">Top Mortagages Rates</a></li>
                            <li><a href="">Terms of use</a></li>
                            <li><a href="">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="bottom_footer">
        <div>
            <p>{{ siteSettings()->copy_right_text}}</p>
        </div>
    </div>
</body>
<script rel="stylesheet" src="{{asset('include/js/jquery-3.7.1.min.js')}}"></script>
<script rel="stylesheet" src="{{asset('include/js/all.js')}}"></script>
<script rel="stylesheet" src="{{asset('include/js/bootstrap.bundle.min.js')}}"></script>
<script rel="stylesheet" src="{{asset('include/js/script.js')}}"></script>
</html>