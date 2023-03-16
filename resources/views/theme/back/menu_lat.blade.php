<aside class="main-sidebar sidebar-dark-warning elevation-4" style="background-color: white;">
    <div class="pantallaMenuLat" style="width: 100%;height: 100%;background-color: rgba(255, 255, 255, 0.6)">
        <!-- Brand Logo -->
        <a href="#" class="brand-link"
            style=" background-image: linear-gradient(to bottom right, #FFF, #fbb800);">
            <img src="{{ asset('imagenes/sistema/logo.png') }}" alt="Sistema Prueba"
                class="brand-image img-circle elevation-3" style="opacity: .9;max-width: 80px;">
            <div class="row">
                <div class="col-12">
                    <span class="brand-text font-weight-light"
                        style="color: white;text-shadow: 1px 1px black;font-size: 1.2em;font-weight: bold;">UNISALLE</span>
                </div>
            </div>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('imagenes/usuarios/' . session('foto')) }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    @if (session('rol_id') < 3)
                    <h6 class="d-block"><strong>{{session('rol_nombre')}}</strong></h6>
                    @else
                    <h6 class="d-block"><strong>{{session('area')}}</strong></h6>
                    <p class="d-block">{{session('cargo')}}</p>
                    @endif

                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2" style="color: #064149; font-weight: 500;">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-header">
                        <h6 style="color: #05343a; font-weight: 700;">MEN&Uacute; PRINCIPAL</h6>
                    </li>
                    @foreach ($menusComposer as $key => $item)
                        @if ($item['menu_id'] != 0)
                        @break
                    @endif
                    @include("theme.back.menu-item", ["item" => $item])
                    @endforeach
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </div>
</aside>
