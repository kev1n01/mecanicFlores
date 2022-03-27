<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('home') }}" class="site_title">
                <img width="50px" src="{{ asset('assets/build/images/logomecanic.png') }}"
                    alt="Taller automotriz Flores">
                <span>Taller Flores</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                    class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Bienvenido,</span>
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
                        <li><a href="{{ route('home') }}"
                                class="nav-link {{ request()->is('admin/home') ? 'active' : '' }}"><i
                                    class="fa fa-home"></i> Home </span></a></li>
                    @endif

                    @if (canView('vendedor'))
                        <li><a><i class="fa fa-dropbox"></i> Inventario <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                {{-- <li><a href="{{route('categories-products.index')}}" class="nav-link {{(request()->is('admin/categories-products/index')) ? 'active' : '' }}">Categorias</a></li> --}}

                                <li><a href="index2.html">Marcas</a></li>
                                <li><a href="index3.html">Proveedores</a></li>
                                <li><a href="index3.html">Productos</a></li>
                                <li><a href="index3.html">Compras</a></li>
                            </ul>
                        </li>
                    @endif

                    @if (canView('cliente'))
                        <li><a><i class="fa fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('users.index') }}"
                                        class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">Todos los
                                        usuarios</a></li>
                                <li><a href="{{ route('roles.index') }}"
                                        class="nav-link {{ request()->is('admin/roles') ? 'active' : '' }}">Roles y
                                        permisos</a></li>
                                <li><a href="index2.html">Cliente</a></li>
                                <li><a href="index3.html">Vendedores</a></li>
                                <li><a href="index3.html">Empleados</a></li>
                            </ul>
                        </li>
                    @endif

                    @if (canView('empleado'))
                        <li><a><i class="fa fa-car"></i> Vehiculos <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                {{-- <li><a href="{{route('vehicle.list')}}" class="nav-link {{(request()->is('vehicle/list')) ? 'active' : '' }}">Lista de vehiculos</a></li> --}}
                            </ul>
                        </li>
                    @endif

                    @if (canView('empleado'))
                        <li><a><i class="fa fa-wrench"></i> Servicios <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                {{-- <li><a href="{{route('service.list')}}" class="nav-link {{(request()->is('service/list')) ? 'active' : '' }}">Lista de servicios</a></li> --}}
                            </ul>
                        </li>
                    @endif

                    @if (canView('empleado'))
                        <li><a><i class="fa fa-file-lines"></i> Cotizacion <span class="fa fa-chevron-down"></span></a>
                        </li>
                    @endif

                    @if (canView('vendedor'))
                        <li><a><i class="fa fa-cash-register"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                        </li>
                    @endif

                    @if (canView('vendedor'))
                        <li><a><i class="fa fa-file-lines"></i> Facturas <span class="fa fa-chevron-down"></span></a>
                        </li>
                    @endif
                </ul>
            </div>


        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            @role('administrador')
                <a style="width: 50%;" data-toggle="tooltip" data-placement="top" title="Ajustes">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                </a>
            @endrole
            <a style="width: 50%;" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="top" title="Salir">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>

            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
            </form>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
