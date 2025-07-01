@if(auth()->user()->can('view_staff') || auth()->user()->can('view_role'))       
    <li class="sidebar-list {{ request()->is('human-resources/*') ? 'active' : '' }}">
        <i class="fa fa-thumb-tack"></i>
        <a class="sidebar-link sidebar-title {{ request()->is('human-resources/*') ? 'active' : '' }}" href="#">
            <svg class="stroke-icon">
                <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-social"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{ asset('images/design/icon-sprite.svg') }}#fill-social"></use>
            </svg>
            <span>Human Resources</span>
            <div class="according-menu"><i class="fa fa-angle-right"></i></div>
        </a>
        <ul class="sidebar-submenu">
            @can('view_role')
                <li class="{{ request()->is('human-resources/role*') ? 'active' : '' }}">
                    <a href="{{ route('human-resources.role.index') }}">Role</a>
                </li>
            @endcan
            @can('view_staff')
                <li class="{{ request()->is('human-resources/manage-staff/*') ? 'active' : '' }}">
                    <a href="{{ route('human-resources.manage-staff.index') }}">Manage Staff</a>
                </li>
            @endcan
        </ul>
    </li>
@endcan