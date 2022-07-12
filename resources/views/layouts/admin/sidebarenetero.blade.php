<aside class="app-navbar">
    <!-- begin sidebar-nav -->
    <div class="sidebar-nav scrollbar scroll_light">
        <ul class="metismenu " id="sidebarNav">


            @if (canView('usuario'))
            <li class="{{ request()->is('admin/home') ? 'active' : '' }}">
                <a href="{{ route('admin.home') }}"
                    aria-expanded="false"><i class="nav-icon ti ti-home"></i><span class="nav-title">Dashboard</span></a>
            </li>
            @endif
            @if (canView('usuario'))
                    <li class="{{ request()->is('admin/users','admin/roles') ? 'active' : '' }}">
                        <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <i class="nav-icon ti ti-user"></i>
                            <span class="nav-title">Control de usuario</span>
                        </a>
                        <ul aria-expanded="false" >
                            <li class="{{ request()->is('admin/users') ? 'active' : '' }}">
                                <a href="{{ route('users.table') }}">Usuarios</a> </li>
                            <li class="{{ request()->is('admin/roles') ? 'active' : '' }}">
                                <a href="{{ route('roles.table') }}">Roles y permisos</a> </li>

                        </ul>
                    </li>
                @endif
            @if (canView('usuario'))
                <li class="{{ request()->is('admin/providers','admin/products','admin/purchases') ? 'active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i class="nav-icon ti ti-package"></i>
                        <span class="nav-title">Gestión de inventario</span>
                    </a>
                    <ul aria-expanded="false" >
                        <li class="{{ request()->is('admin/providers') ? 'active' : '' }}">
                            <a href="{{ route('providers.table') }}">Proveedores</a> </li>
                        <li class="{{ request()->is('admin/products') ? 'active' : '' }}">
                            <a href="{{ route('products.table') }}">Productos</a> </li>
                        <li class="{{ request()->is('admin/purchases') ? 'active' : '' }}">
                            <a href="{{ route('purchases.table') }}">Compras</a> </li>
                    </ul>
                </li>
            @endif
                @if (canView('vendedor'))
                    <li class="{{ request()->is('admin/sales','admin/sales/create') ? 'active' : '' }}">
                        <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <i class="nav-icon ti ti-shopping-cart-full"></i>
                            <span class="nav-title">Ventas</span>
                        </a>
                        <ul aria-expanded="false" >
                            <li class="{{ request()->is('admin/sales') ? 'active' : '' }}">
                                <a href="{{ route('sales.table') }}">Lista de ventas</a> </li>
                            <li class="{{ request()->is('admin/sales/create') ? 'active' : '' }}">
                                <a href="{{ route('sales.create') }}">Realizar venta</a> </li>

                        </ul>
                    </li>
                @endif
                <li >
                    <a href="{{ route('user.home') }}"><i class="nav-icon fa fa-th "></i><span class="nav-title">Ir tienda</span></a>
                </li>
        </ul>
    </div>
    <!-- end sidebar-nav -->
</aside>
