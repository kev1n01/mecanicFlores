<div>

    <nav aria-label="breadcrumb breadcrumb-custom">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active " aria-current="page">Compras</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <div class="row ">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-2   ">
                            <select wire:model="perPage" class="form-control">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class=" col-md-10 ">
                            <input type="text" wire:model="search" class="form-control "
                                   placeholder="Busqueda por datos en general ">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-dark color-basic " data-toggle="tooltip" data-placement="top" title="Limpiar filtros"
                            type="button" wire:click="clear">
                        <i class="fa fa-eraser"></i><span> Limpiar</span>
                    </button>

                    @can('usuario create')
                        <div class="btn-group mb-1">
                            <button type="button" class="btn btn-dark color-basic dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-plus"></i> Crear Nuevo
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('sales.create') }}"> Venta</a>
                            </div>
                        </div>
                    @endcan

                    <div class="btn-group mb-1">
                        <button type="button" class="btn btn-dark color-basic dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            Exportar
                            @if ($selectedRows)
                                <span class="badge badge-default" style="background-color: white; color: #0f0f0f;">{{  count($selectedRows)  }}</span>
                            @endif
                        </button>
                        <div class="dropdown-menu" >
                            {{--                    <a class="dropdown-item " href="{{ route('providers.pdf') }}"><i class="fas fa-file-pdf"></i> PDF</a>--}}
                            <a class="dropdown-item" wire:click.prevent="export('pdf')"><i class="fas fa-file-pdf"></i> PDF SIMPLE</a>
                            <a class="dropdown-item" wire:click.prevent="export('excel')"><i class="fas fa-file-excel"></i> XLSX</a>
                            <a class="dropdown-item" wire:click.prevent="export('csv')"><i class="fas fa-file-csv"></i> CSV</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th></th>
                        <th>
                            <select class="form-control " wire:model="customer_id">
                                <option value="">Seleciona cliente</option>
                                @foreach ($userCustomers as  $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <input class="form-control date" placeholder="fecha" type="text" wire:model="dateSearch" >
                        </th>
                        <th>
                            <select class="form-control " wire:model="sale_status_id">
                                <option value="">Seleciona estado</option>
                                @foreach ($status as $key => $statu)
                                    <option value="{{ $key }}">{{ $statu }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <input class="form-control" placeholder="total" type="text" wire:model="totalSearch" >
                        </th>
                        <th>
                            <select class="form-control " wire:model="sale_status_id">
                                <option value="">Seleciona vendedor</option>
                                @foreach ($userSellers as $key => $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th class="icon-filter">
                            <span>
                                <i class="ti ti-filter"></i>
                                Filtrar por
                            </span>
                        </th>
                    </tr>

                    <thead style="background: #2A3F54; color: white;">

                    <tr>
                        <th class="table-th text-center">
                            <div class="icheck-primary" style="height: 15px">
                                <input wire:model="selectPageRows" type="checkbox" value="1" name="todo2"
                                       id="todoCheck2">
                                <label for="todoCheck2"></label>
                            </div>
                        </th>
                        <th width="20%" wire:click="sortable('customer_id')" class="th-pointer table-th text-center" scope="col">Cliente
                            <span class=" th-span fa fa{{ $camp === 'customer_id' ? $icon : '-sort' }} "></span>
                        </th>
                        <th class="table-th text-center" scope="col">Fecha</th>
                        <th class="table-th text-center" scope="col">Estado</th>
                        <th width="15%" wire:click="sortable('total')" class="th-pointer table-th text-center" scope="col">Total
                            <span class=" th-span fa fa{{ $camp === 'total' ? $icon : '-sort' }}"></span>
                        </th>
                        <th class="th-pointer table-th text-center" wire:click="sortable('user_id')" scope="col">Vendedor
                            <span class=" th-span fa fa{{ $camp === 'user_id' ? $icon : '-sort' }}"></span></th>
                        <th class="table-th text-center" scope="col">Acciones</th>
                    </tr>
                    </thead>
                    @if ($sales->count())
                        <tbody>
                        @foreach ($sales as $sale)
                            <tr class="tr-custom">
                                <th style="width: 10px;">
                                    <div class="icheck-primary d-inline">
                                        <input wire:model="selectedRows" type="checkbox" value="{{ $sale->id }}"
                                               name="todo2" id="{{ $sale->id }}">
                                        <label for="{{ $sale->id }}"></label>
                                    </div>
                                </th>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->created_at }}</td>
                                <td>{{ $sale->sale_status->name }}</td>
                                <td>S/. {{ $sale->total }}</td>
                                <td>{{ $sale->user->name }}</td>

                                <td width="12%">
                                    @can('usuario update')
                                        <a href="javascript:void(0)" class="btn btn-dark color-basic "
                                           wire:click="$emit('toogleModalPurchase',{{ $sale->id }},'Purchase')" data-toggle="tooltip" data-placement="top"
                                           title="Editar compra">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('usuario delete')
                                        {{--                                        <a href="javascript:void(0)" class="btn btn-danger"--}}
                                        {{--                                           wire:click="deletePurchase({{ $purchase->id }})" data-toggle="tooltip" data-placement="top"--}}
                                        {{--                                           title="Eliminar compra">--}}
                                        {{--                                            <i class="fa fa-trash"></i>--}}
                                        {{--                                        </a>--}}
                                    @endcan

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    @endif
                </table>
            </div>

            {{ $sales->links() }}

            {{--            @if (($codeSearch || $nameSearch || $stockSearch) && !$purchases->count())--}}
            {{--                <div>--}}
            {{--                    No hay resultados para la búsqueda "--}}
            {{--                    @if ($nameSearch)--}}
            {{--                        {{ $nameSearch }}--}}
            {{--                    @endif--}}
            {{--                    @if ($codeSearch)--}}
            {{--                        {{ $codeSearch }}--}}
            {{--                    @endif--}}
            {{--                    @if ($stockSearch)--}}
            {{--                        {{ $stockSearch }}--}}
            {{--                    @endif--}}
            {{--                    " en la página {{ $page }} al mostrar {{ $perPage }} registros--}}
            {{--                </div>--}}
            {{--            @endif--}}
            @if (!$sales->count() )
                <div>
                    No hay compras registradas. Registre nuevas compras pulsando el boton "+"
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')

@endpush

@push('scripts')

    <script>

    </script>

@endpush

