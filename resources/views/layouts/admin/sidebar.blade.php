<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title " style="border: 0; ">
            <a href="{{ route('admin.home') }}" class="site_title" style="font-size: 20px;">
                <img width="50px" height="48px" src="{{ asset('assets/build/images/logomecanic.png') }}"
                    alt="Taller automotriz Flores">
                TALLER <strong style="color: #007bff;">FLORES</strong>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                    class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Bienvenido</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    @if (canView('usuario'))
                        <li><a href="{{ route('admin.home') }}"
                                class="nav-link {{ request()->is('admin/home') ? 'active' : '' }}"><i
                                    class="fa fa-home"></i> Home </span></a></li>
                    @endif

                    @if (canView('usuario'))
                        <li><a><i class="fa fa-dropbox"></i> Inventario <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('providers.table') }}"
                                       class="nav-link {{ request()->is('admin/providers') ? 'active' : '' }}">Proveedores</a></li>
                                <li><a href="{{ route('products.table') }}"
                                       class="nav-link {{ request()->is('admin/products') ? 'active' : '' }}">Productos</a></li>
                                <li><a href="{{ route('purchases.table') }}"
                                       class="nav-link {{ request()->is('admin/purchases') ? 'active' : '' }}">Compras</a></li>

                            </ul>
                        </li>
                    @endif

                    @if (canView('usuario'))
                        <li><a><i class="fa fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('users.table') }}"
                                        class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">Lista de usuarios</a></li>
                                <li><a href="{{ route('roles.table') }}"
                                        class="nav-link {{ request()->is('admin/roles') ? 'active' : '' }}">Roles y
                                        permisos</a></li>
                            </ul>
                        </li>
                    @endif

                    @if (canView('vendedor'))
                            <li><a><i class="fa fa-cash-register"></i>Control de ventas<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('sales.table')}}" class="nav-link {{(request()->is('admin/sales')) ? 'active' : '' }}">
                                          Ventas registradas</a></li>
                                     <li><a href="{{route('sales.create')}}" class="nav-link {{(request()->is('admin/sales/create')) ? 'active' : '' }}">
                                             Realizar una venta</a></li>

                                </ul>
                            </li>
                    @endif
                </ul>
            </div>


        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            @if (canView('usuario'))
                <a style="width: 100%;" data-toggle="tooltip" data-placement="top" title="Ajustes">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                </a>
            @endif

        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
