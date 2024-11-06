@php

// pengecekan untuk URL tiap Role

$url = "";
if (auth()->user()->role === "superadmin"){
    $url = "/superadmin/dashboard";
} elseif (auth()->user()->role === "admin"){
    $url = "/admin/dashboard";
} else {
    $url = "/user/dashboard";
}

@endphp

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="{{ $url }}" class="brand-link"> <!--begin::Brand Image--> <img src="{{ URL::asset('adminlte-4/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">AdminLTE 4</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{ $url }}" class="nav-link {{ request()->is('superadmin/dashboard*') || request()->is('admin/dashboard*') || request()->is('user/dashboard*')  ? 'active' : '' }}"> <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a> 
                </li>
                @if (auth()->user()->role === "superadmin" || auth()->user()->role === "admin")
                    <li class="nav-item">
                        <a href="#" class="nav-link"> <i class="nav-icon bi bi-people"></i>
                            <p>User Management</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"> <i class="nav-icon bi bi-postcard"></i>
                            <p>All Posts</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link"> <i class="nav-icon bi bi-file-post"></i>
                        <p>My Posts</p>
                    </a>
                </li>

                @if (auth()->user()->role === "superadmin" || auth()->user()->role === "admin")
                <li class="nav-item">
                    <a href="/category" class="nav-link {{ request()->is('category*') ? 'active' : '' }}"> <i class="nav-icon bi bi-tags"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"> <i class="nav-icon bi bi-chat"></i>
                        <p>Comments</p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="/profile" class="nav-link"> <i class="nav-icon bi bi-lock"></i>
                        <p>Change Password</p>
                    </a> 
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->