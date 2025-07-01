<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        const APP_URL = '{{url('/')}}';
        const APP_TOKEN = '{{csrf_token()}}';
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Amit Saha">
    <link rel="icon" href="{{asset(siteSettings()->favicon)}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset(siteSettings()->favicon)}}" type="image/x-icon">
    <title>
        @if (trim($__env->yieldContent('title')))
            @yield('title') | {{ siteSettings()->company_name}}
        @else

        @endif
    </title>
    <link rel="stylesheet" href="{{ asset('css/backend/toastr.css') }}" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/vendors/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/responsive.css') }}">
      <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader">
            <div class="loader4"></div>
        </div>
    </div>

    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="logo-wrapper">
                    <a href="{{route('dashboard')}}">
                        <img class="img-fluid for-light" src="" alt="logo-light">
                        <img class="img-fluid for-dark" src="" alt="logo-dark">
                    </a>
                    </div>
                    <div class="toggle-sidebar"> <i class="status_toggle middle sidebar-toggle"
                            data-feather="align-center"></i></div>
                </div>
                <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
                    <div> <a class="toggle-sidebar" href="#"> <i class="iconly-Category icli"> </i></a>
                        <div class="d-flex align-items-center gap-2 ">
                            <h4 class="f-w-600">Welcome To {{ siteSettings()->company_name}} <strong>{{ auth()->user()->name }}</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
                    <ul class="nav-menus">
                        <!-- Quick Link Section -->
                        {{-- <li class="onhover-dropdown">
                            <svg>
                                <use href="{{ asset('images/design/icon-sprite.svg') }}#star"></use>
                            </svg>
                            <div class="onhover-show-div bookmark-flip">
                                <div class="flip-card">
                                    <div class="flip-card-inner">
                                        <div class="front">
                                            <h6 class="f-18 mb-0 dropdown-title">Quick Links</h6>
                                            <ul class="bookmark-dropdown">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-4 text-center">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i
                                                                        data-feather="file-text"></i></div>
                                                                <span>Forms</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 text-center">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i data-feather="user"></i>
                                                                </div><span>Profile</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 text-center">
                                                            <div class="bookmark-content">
                                                                <div class="bookmark-icon"><i
                                                                        data-feather="server"></i></div>
                                                                <span>Tables</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="back">
                                            <ul>
                                                <li>
                                                    <div class="bookmark-dropdown flip-back-content">
                                                        <input type="text" placeholder="search...">
                                                    </div>
                                                </li>
                                                <li><a class="f-w-700 d-block flip-back" id="flip-back"
                                                        href="javascript:void(0)">Back</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                        <!-- Notification Section -->
                        {{-- <li class="onhover-dropdown notification-down">
                            <div class="notification-box">
                                <svg>
                                    <use href="{{ asset('images/design/icon-sprite.svg') }}#notification-header">
                                    </use>
                                </svg><span class="badge rounded-pill badge-secondary">4 </span>
                            </div>
                            <div class="onhover-show-div notification-dropdown">
                                <div class="card mb-0">
                                    <div class="card-header">
                                        <div class="common-space">
                                            <h4 class="text-start f-w-600">Notitications</h4>
                                            <div><span>4 New</span></div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="notitications-bar">
                                            <div class="notification-card">
                                                <ul>
                                                    <li
                                                        class="notification d-flex w-100 justify-content-between align-items-center">
                                                        <div
                                                            class="d-flex w-100 notification-data justify-content-center align-items-center gap-2">
                                                            <div class="user-alerts flex-shrink-0"><img
                                                                    class="rounded-circle img-fluid img-40"
                                                                    src="../assets/images/dashboard/user/3.jpg"
                                                                    alt="user" /></div>
                                                            <div class="flex-grow-1">
                                                                <div class="common-space user-id w-100">
                                                                    <div class="common-space w-100"> <a
                                                                            class="f-w-500 f-12"
                                                                            href="private-chat.html">Robert D.</a>
                                                                    </div>
                                                                </div>
                                                                <div><span class="f-w-500 f-light f-12">Hello
                                                                        Miss</span></div>
                                                            </div><span class="f-light f-w-500 f-12">44 sec</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-footer pb-0 pr-0 pl-0">
                                                <div class="text-center"> <a class="f-w-700"
                                                        href="private-chat.html">
                                                        <button class="btn btn-primary" type="button"
                                                            title="btn btn-primary">Check all</button></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> --}}

                        <!-- Dropdown Profile Section -->
                        <li class="profile-nav onhover-dropdown">
                            <div class="media profile-media">
                                <img class="b-r-10" src="" alt="">
                                <div class="media-body d-xxl-block d-none box-col-none">
                                    <div class="d-flex align-items-center gap-2"> <span>{{ auth()->user()->name }}
                                        </span><i class="middle fa fa-angle-down"> </i></div>
                                    <p class="mb-0 font-roboto">{{ auth()->user()->role->name }}</p>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li>
                                    <a href="{{ route('customers.manage-customer.details', ['id' => auth()->user()->uuid, 'tab' => 'basic-info']) }}">
                                        <i data-feather="settings"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('customers.manage-customer.change-password-index')}}">
                                        <i data-feather="settings"></i>
                                        <span>Password</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-pill btn-outline-primary btn-sm" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('LogOut') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">gfdgdfg</div>
            </div>
            </div>
          </script>
                <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
            </div>
        </div>

        <div class="page-body-wrapper">
            <!-- Page Sidebar -->
            @if (auth()->user()->role->id == 4)
                @includeIf('backEnd.customer_sidebar')
            @else
                @includeIf('backEnd.sidebar_menu')
            @endif
            <!-- Body Content-->
            @yield('dashboard_content')

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">{{ siteSettings()->copy_right_text}}</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('js/backend/jquery.min.js') }}"></script>
    <script src="{{ asset('js/backend/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/backend/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('js/backend/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="{{ asset('js/backend/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('js/backend/scrollbar/custom.js') }}"></script>
    <script src="{{ asset('js/backend/config.js') }}"></script>
    <script src="{{ asset('js/backend/sidebar-menu.js') }}"></script>
    <script src="{{ asset('js/backend/sidebar-pin.js') }}"></script>
    <script src="{{ asset('js/backend/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/backend/select2/select2-custom.js') }}"></script>

    <script src="{{ asset('js/backend/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/backend/datatable/datatables/datatable.custom.js') }}"></script>

    <script src="{{ asset('js/backend/flat-pickr/flatpickr.js') }}"></script>
    <script src="{{ asset('js/backend/flat-pickr/custom-flatpickr.js') }}"></script>
    <script src="{{ asset('js/backend/sweetalert.js') }}"></script>
    <script src="{{ asset('js/backend/script.js') }}"></script>
    <script src="{{ asset('js/backend/developer.js') }}"></script>
    <script src="{{ asset('js/backend/theme-customizer/customizer.js') }}"></script>
    <script src="{{ asset('js/backend/toastr.min.js') }}" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('scripts')
</body>

</html>
