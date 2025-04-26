<div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="./index.html" class="text-nowrap logo-img">
            <img src="{{ asset('images/dark-logo.svg') }}" width="180" alt="" />
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
        </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow d-flex align-items-center" href="#managementSubmenu"
                    data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="managementSubmenu">
                    <span><i class="ti ti-menu-2"></i></span>
                    <span class="hide-menu ms-2">Management</span>
                    <span class="arrow ms-auto">
                        <i class="ti ti-chevron-down"></i>
                    </span>
                </a>
                <ul class="collapse ms-5" id="managementSubmenu">
                    <li class="sidebar-item">
                        <a href="./users.html" class="sidebar-link">Users</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="./roles.html" class="sidebar-link">Roles</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="./roles.html" class="sidebar-link">Permissions</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('site configuration')}}" aria-expanded="false">
                    <span>
                        <i class="ti ti-world"></i>
                    </span>
                    <span class="hide-menu">Business Setup</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- End Sidebar navigation -->
</div>
