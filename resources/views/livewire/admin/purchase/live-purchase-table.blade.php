<div>
    <nav aria-label="breadcrumb breadcrumb-custom">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active " aria-current="page">Compras</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <div class="col-md-1  col-sm-2 ">
                <select wire:model="perPage" class="form-control">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="form-group col-md-4 col-sm-10 search">
                <input type="text" wire:model="search" class="form-control "
                       placeholder="Busqueda por datos en general ">
            </div>

            <button class="btn btn-dark color-basic " data-toggle="tooltip" data-placement="top" title="Limpiar filtros"
                    type="button" wire:click="clear">
                <i class="fas fa-eraser"></i><span> Limpiar</span>
            </button>

            @can('usuario create')
                <div class="btn-group mb-1">
                    <button type="button" class="btn btn-dark color-basic dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Crear
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('purchases_create.table') }}"><i class="fas fa-plus"></i> Compra</a>
                        <a class="dropdown-item" wire:click="$emit('toogleModalPurchase')"><i class="fas fa-plus"></i> CompraModal </a>
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

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th></th>
                        <th>
                            <input class="form-control" placeholder="código" type="text" wire:model="codeSearch">
                        </th>

                        <th>
                            <input class="form-control" placeholder="fecha" type="date" wire:model="dateSearch" >
                        </th>

                        <th>
                            <input class="form-control" placeholder="observacion" type="text" wire:model="observationSearch">
                        </th>

                        <th>
                            <select class="form-control " wire:model="provider_id">
                                <option value="">Seleciona proveedor</option>
                                @foreach ($providers as $key => $provider)
                                    <option value="{{ $key }}">{{ $provider}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <select class="form-control " wire:model="user_id">
                                <option value="">Seleciona usuario</option>
                                @foreach ($users as $key => $user)
                                    <option value="{{ $key }}">{{ $user }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th>
                            <select class="form-control " wire:model="purchase_status_id">
                                <option value="">Seleciona estado</option>
                                @foreach ($status as $key => $statu)
                                    <option value="{{ $key }}">{{ $statu }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th class="icon-filter">
                            <span>
                                <i class="fas fa-filter"></i>
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

                        <th width="10%" wire:click="sortable('code_purchase')" class="th-pointer table-th text-center" scope="col">Código
                            <span class=" th-span fas fa{{ $camp === 'code_purchase' ? $icon : '-sort' }} "></span>
                        </th>
                        <th width="15%" wire:click="sortable('date_purchase')" class="th-pointer table-th text-center" scope="col">Fecha
                            <span class=" th-span fas fa{{ $camp === 'date_purchase' ? $icon : '-sort' }}"></span>
                        </th>

                        <th wire:click="sortable('observation')" class="th-pointer table-th text-center" scope="col">Observación
                            <span class=" th-span fas fa{{ $camp === 'observation' ? $icon : '-sort' }}"></span>
                        </th>

                        <th class="table-th text-center" scope="col">Proveedor</th>

                        <th class="table-th text-center" scope="col">Usuario</th>

                        <th class="table-th text-center" scope="col">Estado</th>

                        <th class="table-th text-center" scope="col">Acciones</th>
                    </tr>
                    </thead>
                    @if ($purchases->count())
                        <tbody>
                        @foreach ($purchases as $purchase)
                            <tr class="tr-custom">
                                <th style="width: 10px;">
                                    <div class="icheck-primary d-inline">
                                        <input wire:model="selectedRows" type="checkbox" value="{{ $purchase->id }}"
                                               name="todo2" id="{{ $purchase->id }}">
                                        <label for="{{ $purchase->id }}"></label>
                                    </div>
                                </th>

                                <td>{{ $purchase->code_purchase }}</td>
                                <td>{{ $purchase->date_purchase }}</td>
                                <td>{{ $purchase->observation }}</td>
                                <td>{{ $purchase->provider->name }}</td>
                                <td>{{ $purchase->user->name }}</td>
                                <td>
                                    {{ $purchase->purchase_status->name ?? 'None'}}
                                </td>

                                <td width="12%">
                                    @can('usuario update')
                                        <a href="javascript:void(0)" class="btn btn-dark color-basic "
                                           wire:click="$emit('toogleModalPurchase',{{ $purchase->id }},'Purchase')" data-toggle="tooltip" data-placement="top"
                                           title="Editar compra">
                                            <i class="far fa-edit"></i>
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

            {{ $purchases->links() }}

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
            @if (!$purchases->count() && !$codeSearch && !$dateSearch && !$observationSearch)
                <div>
                    No hay compras registradas. Registre nuevas compras pulsando el boton "+"
                </div>
            @endif
        </div>
    </div>
</div>

@push('modals')
        @livewire('admin.modal.purchase.modal-purchase')
    {{--    @livewire('admin.modal.status.modal-status-provider')--}}
@endpush

@push('styles')

@endpush

@push('scripts')

    <script>

        window.addEventListener('close-modal', event => {
            $('#PurchaseModal').modal('hide');
        });
        window.addEventListener('open-modal', event => {
            $('#PurchaseModal').modal('show');
        });
        window.addEventListener('open-modal-status', event => {
            $('#StatusModalPurchase').modal('show');
        });
        window.addEventListener('close-modal-status', event => {
            $('#StatusModalPurchase').modal('hide');
        });

    </script>

@endpush
