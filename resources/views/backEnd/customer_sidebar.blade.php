<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div class="logo-wrapper">
        <a href="{{route('dashboard')}}"><img class="img-fluid" src="../assets/images/logo/logo.png" alt=""></a>
        <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
    </div>
    <div class="logo-icon-wrapper">
        <a href="{{route('dashboard')}}"><img class="img-fluid" src="#" alt=""></a>
    </div>
    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn"><a href="{{route('dashboard')}}"><img class="img-fluid"
                            src="#" alt=""></a>
                    <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2"
                            aria-hidden="true"></i></div>
                </li>
                <li class="pin-title sidebar-main-title">
                    <div>
                        <h6>Pinned</h6>
                    </div>
                </li>
                <li class="sidebar-main-title">
                    <div>
                        <h6 class="lan-1">General</h6>
                    </div>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('dashboard*') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-home"></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-home"></use>
                        </svg>
                        <span>Dashboard</span>
                        <div class="according-menu">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                </li>

                <li class="sidebar-list {{ request()->is('customer/*') ? 'active' : '' }}">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title {{ request()->is('customer/*') ? 'active' : '' }}" href="#">
                        <svg class="stroke-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-support-tickets"></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-support-tickets"></use>
                        </svg>
                        <span>Package Info</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->is('customer/package-requests*') ? 'active' : '' }}">
                            <a href="{{ route('customer.package-requests') }}">Package Request</a>
                        </li>
                        <li class="{{ request()->is('customer/my-packages*') || request()->is('customer/package/*') ? 'active' : '' }}">
                            <a href="{{ route('customer.packages.my-packages') }}">My Package</a>
                        </li>
                        <li class="{{ request()->is('customer/packages*') ? 'active' : '' }}">
                            <a href="{{ route('customer.packages.index') }}">All Package</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-list {{ request()->is('helpdesk/*') ? 'active' : '' }}">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title {{ request()->is('helpdesk/*') ? 'active' : '' }}" href="#">
                        <svg class="stroke-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-support-tickets"></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-support-tickets"></use>
                        </svg>
                        <span>Helpdesk</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->is('helpdesk/tickets*') ? 'active' : '' }}">
                            <a href="{{ route('helpdesk.tickets.index') }}">Tickets</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('custom-order*') ? 'active' : '' }}"
                        href="{{ route('custom-order.index') }}"> <svg class="stroke-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-task"></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-task"></use>
                        </svg>
                        <span>Custom Order</span>
                        <div class="according-menu">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</div>
