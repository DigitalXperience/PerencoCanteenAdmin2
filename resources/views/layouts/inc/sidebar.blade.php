<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 100vh;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Cantine</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                @if(auth()->user()->usertype == 'admin')
                <li class="nav-item">
                    <a href="{{ url('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('chart')}}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Graphe</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/users-who-ate') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Historique</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('rapport') }}" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Rapport</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('users') }}" class="nav-link">
                        <i class="nav-icon  fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('delete-users') }}" class="nav-link">
                        <i class="nav-icon  fas fa-users"></i>
                        <p>supprimer</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
