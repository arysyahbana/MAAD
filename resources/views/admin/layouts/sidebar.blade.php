<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('dist_frontend/img/CODIAS.png') }}" alt="" width="50px" class="img-fluid py-2">
        </div>
        <div class="sidebar-brand-text mx-3">MAAD</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin_dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin_rekap_show') }}">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Data Summary</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-files fa-cog"></i>
            <span>Rekap Data</span></a>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin_rekap_show') }}">Rekap Semua Data</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> --}}
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin_category_show') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Category</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin_price_show') }}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Price</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin-post-show') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Post</span></a>
    </li>
    {{-- <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin_subCategory_show') }}">
            <i class="fa fa-file"></i>
            <span>Sub Category</span></a>
    </li> --}}
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin_user_show') }}">
            <i class="fas fa-users fa-cog"></i> <span>Users</span>
            @if ($notif = App\Models\User::where('role', 'pending')->count())
                <span class="badge badge-danger">
                    {{ $notif }}
                </span>
            @endif

        </a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
