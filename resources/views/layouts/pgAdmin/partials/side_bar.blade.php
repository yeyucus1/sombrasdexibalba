<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <i class="img-circle text-white elevation-2 fas fa-user fa-2x"></i>
        </div>
        <div class="info">
            <a href="/user/profile" class="d-block">{{auth()->user()->pseudonym}}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
                <a href="{{route('writer.home')}}" class="{{\Illuminate\Support\Facades\Route::currentRouteName()=='writer.home'?'nav-link active':'nav-link'}}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Inicio
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/widgets.html" class="nav-link">
                    <i class="fas fa-house-user"></i>
                    <p>
                        Casas
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
