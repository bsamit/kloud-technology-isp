<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div class="logo-wrapper">
        <a href="{{route('dashboard')}}"><img class="img-fluid" src="#" alt=""></a>
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

                {{-- <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('component') }}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-home"></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-home"></use>
                        </svg>
                        <span>Component</span>
                        <div class="according-menu">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                </li> --}}

                {{-- Project Menu Start --}}

             <li class="sidebar-list {{ request()->is('manage-package/*') ? 'active' : '' }}">
                <i class="fa fa-thumb-tack"></i>
                <a class="sidebar-link sidebar-title {{ request()->is('manage-package/*') ? 'active' : '' }}" href="#">
                    <svg class="stroke-icon">
                        <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-task"></use>
                    </svg>
                    <svg class="fill-icon">
                        <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-task"></use>
                    </svg>
                    <span>Manage Package</span>
                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                </a>
                <ul class="sidebar-submenu">
                    @can('view_package')
                        <li class="{{ request()->is('manage-package/package/*') ? 'active' : '' }}">
                            <a href="{{ route('manage-package.package.index') }}">List</a>
                        </li>
                    @endcan
                    <li class="{{ request()->is('manage-package/package-requests/*') ? 'active' : '' }}">
                        <a href="{{ route('manage-package.package-requests.index') }}">
                            Request
                        </a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-list {{ request()->is('purchase-package/*') ? 'active' : '' }}">
                <i class="fa fa-thumb-tack"></i>
                <a class="sidebar-link sidebar-title {{ request()->is('purchase-package/*') ? 'active' : '' }}" href="#">
                    <svg class="stroke-icon">
                        <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-user"></use>
                    </svg>
                    <svg class="fill-icon">
                        <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-user"></use>
                    </svg><span>Purchase Package</span>
                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a class="{{ request()->is('purchase-package/inactive/package/index') ? 'active' : '' }}" href="{{route('purchase-package.inactive-package-index')}}">Inactive</a></li>
                    <li><a class="{{ request()->is('purchase-package/active/package/index') ? 'active' : '' }}" href="{{route('purchase-package.active-package-index')}}">Active</a></li>
                    <li><a class="{{ request()->is('purchase-package/expire/package/index') ? 'active' : '' }}" href="{{ route('admin.purchase-package.expired') }}">Expired</a></li>
                </ul>
            </li>

            <li class="sidebar-list">
                <i class="fa fa-thumb-tack"></i>
                <a class="sidebar-link sidebar-title link-nav {{ request()->is('messaging*') ? 'active' : '' }}"
                    href="{{ route('messaging.index') }}"> <svg class="stroke-icon">
                        <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-task"></use>
                    </svg>
                    <svg class="fill-icon">
                        <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-task"></use>
                    </svg>
                    <span>Send Notice</span>
                    <div class="according-menu">
                        <i class="fa fa-angle-right"></i>
                    </div>
                </a>
            </li>

            @if(auth()->user()->can('view_potential_customer') || auth()->user()->can('view_manage_customer'))
            <li class="sidebar-list {{ request()->is('customers/*') ? 'active' : '' }}">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title {{ request()->is('customers/*') ? 'active' : '' }}" href="#">
                        <svg class="stroke-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-user"></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-user"></use>
                        </svg><span>Customers</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu">
                           @can('view_potential_customer')
                        <li>
                            <a class=" {{ request()->is('customers/potential-customer*') ? 'active' : '' }}" href="{{ route('customers.potential-customer.index') }}">potential Customer</a>
                        </li>
                        @endcan
                           @can('view_manage_customer')
                        <li>
                            <a class=" {{ request()->is('customers/manage-customer*') ? 'active' : '' }}" href="{{ route('customers.manage-customer.index') }}">Manage Customer</a>
                        </li>
                        <li>
                            <a class=" {{ request()->is('customers/blocked-customer*') ? 'active' : '' }}" href="{{ route('customers.blocked-customer.index') }}">Blocked Customer</a>
                        </li>
                         @endcan
                    </ul>
                </li>
            @endcan

                <li class="sidebar-list {{ request()->is('manage-bills/*') || request()->is('admin/billing/*') ? 'active' : '' }}">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title {{ request()->is('manage-bills/*') || request()->is('admin/billing/*') ? 'active' : '' }}" href="#">
                        <svg class="stroke-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-others""></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-others""></use>
                        </svg><span>Manage Bills</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                        <li><a class="{{ request()->is('manage-bills/bills/*') ? 'active' : '' }}" href="{{ route('manage-bills.bills.index') }}">Bills</a></li>
                        {{-- <li><a class="{{ request()->is('billing/payments') || request()->is('billing/payments/*') ? 'active' : '' }}" href="{{ route('billing.payments.index') }}">Payments</a></li> --}}
                    </ul>
                </li>

                @includeIf('hr::hr_sidebar_menu')

                <li class="sidebar-list {{ request()->is('general-settings/*') ? 'active' : '' }}">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title {{ request()->is('general-settings/*') ? 'active' : '' }}"href="#">
                        <svg class="stroke-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-ecommerce"></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-ecommerce"></use>
                        </svg>
                        <span>General Settings</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu" style="display: {{ request()->is('general-settings/*') ? 'block' : 'none' }}">
                        <li>
                            <a class="submenu-title {{ request()->is('general-settings/front-settings*') ? 'active' : '' }}" href="#">Front Settings
                                <span class="sub-arrow">
                                    <i class="fa fa-angle-right"></i>
                                </span>
                                <div class="according-menu"><i class="fa {{ request()->is('general-settings/front-settings*') ? 'fa-angle-right' : 'fa-angle-down' }} "></i></div>
                            </a>
    
                            <ul class="nav-sub-childmenu submenu-content {{ request()->is('general-settings/front-settings*') ? 'activechild' : '' }}">
                                <li>
                                    <a href="{{route('general-settings.front-settings.services.index')}}" class="{{ request()->routeIs('general-settings.front-settings.services.index') ? 'active' : '' }}">Services</a>
                                </li>
                                <li>
                                    <a href="{{route('general-settings.front-settings.faq.index')}}" class="{{ request()->routeIs('general-settings.front-settings.faq.index') ? 'active' : '' }}">Faq</a>
                                </li>
                                <li>
                                    <a href="{{route('general-settings.front-settings.services.contact')}}" class="{{ request()->routeIs('general-settings.front-settings.services.contact') ? 'active' : '' }}">Contact Message</a>
                                </li>
                                <li>
                                    <a href="{{ route('general-settings.front-settings.solution-categories.index') }}" class="{{ request()->routeIs('general-settings.front-settings.solution-categories.*') ? 'active' : '' }}">Solution Category</a>
                                </li>
                                <li>
                                    <a href="{{ route('general-settings.front-settings.solutions.index') }}" class="{{ request()->routeIs('general-settings.front-settings.solutions.*') ? 'active' : '' }}">Manage Solution</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="product.html">Payment Settings(D)</a></li>
                        <li><a href="product.html">SMS Settings(D)</a></li>
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
                        <li class="{{ request()->is('helpdesk/helpdesk-categories*') ? 'active' : '' }}">
                            <a href="{{ route('helpdesk.helpdesk-categories.index') }}">Category</a>
                        </li>
                        <li class="{{ request()->is('helpdesk/pending-tickets*') ? 'active' : '' }}">
                            <a href="{{ route('helpdesk.tickets.pending') }}">Pending</a>
                        </li>
                        <li class="{{ request()->is('helpdesk/closed-tickets*') ? 'active' : '' }}">
                            <a href="{{ route('helpdesk.tickets.closed') }}">Closed</a>
                        </li>

                        {{-- <li class="{{ request()->is('helpdesk/answered-tickets*') ? 'active' : '' }}">
                            <a href="{{ route('helpdesk.tickets.answered') }}">Answered Ticket</a>
                        </li> --}}
                        <li class="{{ request()->is('helpdesk/tickets*') ? 'active' : '' }}">
                            <a href="{{ route('helpdesk.tickets.index') }}">All</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-list {{ request()->is('custom-order/*') ? 'active' : '' }}">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title {{ request()->is('custom-order/*') ? 'active' : '' }}" href="#">


                        <svg class="stroke-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-support-tickets"></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-support-tickets"></use>
                        </svg>
                        <span>Custom Order</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->is('custom-order/pending-custom-order*') ? 'active' : '' }}">
                            <a href="{{ route('pending-custom-order') }}">Pending</a>
                        </li>
                        <li class="{{ request()->is('custom-order/approved-custom-order*') ? 'active' : '' }}">
                            <a href="{{ route('approved-custom-order') }}">Approved</a>
                        </li>

                        <li class="{{ request()->is('custom-order/rejected-custom-order*') ? 'active' : '' }}">
                            <a href="{{ route('rejected-custom-order') }}">Rejected</a>
                        </li>
                    </ul>
                </li>

                {{-- Package Management Menu --}}
                

                @if(auth()->user()->can('view_package_requests'))
                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/package-requests*') ? 'active' : '' }}"
                        href="{{ route('package-requests.index') }}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-task"></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-task"></use>
                        </svg>
                        <span>Package Requests</span>
                        @php
                            $pendingRequests = \App\Models\PackageRequest::where('status', 'pending')->count();
                        @endphp
                        @if($pendingRequests > 0)
                            <span class="badge badge-primary">{{ $pendingRequests }}</span>
                        @endif
                    </a>
                </li>
                @endif
            </ul>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</div>
