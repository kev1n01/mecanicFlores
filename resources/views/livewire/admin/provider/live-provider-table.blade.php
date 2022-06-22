<div>
    <nav aria-label="breadcrumb breadcrumb-custom">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
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
                        <a class="dropdown-item" wire:click="$emit('toogleModalProvider')"><i class="fas fa-plus"></i> Proveedor</a>
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
                <table class="table table-striped">
                    <tr>
                        <th></th>
                        <th></th>

                        <th>
                            <input class="form-control" placeholder="nombre" type="text" wire:model="nameSearch">
                        </th>

                        <th>
                            <input class="form-control" placeholder="ruc" type="text" wire:model="rucSearch">
                        </th>

                        <th>
                            <input class="form-control" placeholder="telefono" type="text" wire:model="phoneSearch">
                        </th>

                        <th>
                            <input class="form-control" placeholder="compañia" type="text" wire:model="companySearch">
                        </th>
                        <th>
                            <input class="form-control" placeholder="direccion" type="text" wire:model="addressSearch">
                        </th>

                        <th>
                            <select class="form-control " wire:model="provider_status_id">
                                <option value="">Seleciona estado</option>
                                @foreach ($status as $key => $statu)
                                    <option value="{{ $key }}">{{ $statu }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th class="icon-filter">
                            <span>
                                <i class="fas fa-filter"></i>
                                Filtros
                            </span>
                        </th>
                    </tr>

                    <thead style="background: #2A3F54; color: white;">
                    <tr>
                        <th>
                            <div class="icheck-primary" style="height: 15px">
                                <input wire:model="selectPageRows" type="checkbox" value="1" name="todo2"
                                       id="todoCheck2">
                                <label for="todoCheck2"></label>
                            </div>
                        </th>

                        <th class="table-th text-center" scope="col">Imagen</th>
                        <th width="10%" wire:click="sortable('name')" class="th-pointer table-th text-center" scope="col">Nombre
                            <span class=" th-span fas fa{{ $camp === 'name' ? $icon : '-sort' }} "></span>
                        </th>
                        <th width="15%" wire:click="sortable('ruc')" class="th-pointer table-th text-center" scope="col">Ruc
                            <span class=" th-span fas fa{{ $camp === 'ruc' ? $icon : '-sort' }}"></span>
                        </th>

                        <th wire:click="sortable('phone')" class="th-pointer table-th text-center" scope="col">Celular
                            <span class=" th-span fas fa{{ $camp === 'phone' ? $icon : '-sort' }}"></span>
                        </th>
                        <th wire:click="sortable('name_company')" class="th-pointer table-th text-center" scope="col">Compañia
                            <span class=" th-span fas fa{{ $camp === 'phone' ? $icon : '-sort' }}"></span>
                        </th>
                        <th wire:click="sortable('address')" class="th-pointer table-th text-center" scope="col">Dirección
                            <span class=" th-span fas fa{{ $camp === 'phone' ? $icon : '-sort' }}"></span>
                        </th>

                        <th class="table-th text-center" scope="col">Estado</th>

                        <th class="table-th text-center" scope="col">Acciones</th>
                    </tr>
                    </thead>
                    @if ($providers->count())
                        <tbody>
                        @foreach ($providers as $provider)
                            <tr class="tr-custom">
                                <th style="width: 10px;">
                                    <div class="icheck-primary d-inline">
                                        <input wire:model="selectedRows" type="checkbox" value="{{ $provider->id }}"
                                               name="todo2" id="{{ $provider->id }}">
                                        <label for="{{ $provider->id }}"></label>
                                    </div>
                                </th>

                                <td>
                                    <img src="{{ asset('storage/'.$provider->image_provider) }}" width="60px" height="60px"
                                         class="rounded-circle" alt="{{ $provider->name }}">
                                </td>
                                <td>{{ $provider->name }}</td>
                                <td>{{ $provider->ruc }}</td>
                                <td>{{ $provider->phone }}</td>
                                <td>{{ $provider->name_company }}</td>
                                <td>{{ $provider->address }}</td>
                                <td>
                                    <h6>
                                        <span class=" badge {{ $provider->provider_status->id == 1 ? 'color-basic-2' : 'color-red'}}">
                                            {{ strtoupper($provider->status_name)}}
                                        </span>
                                    </h6>

                                </td>

                                <td width="12%">
                                    @can('usuario update')
                                        <a href="javascript:void(0)" class="btn btn-dark color-basic"
                                           wire:click="$emit('toogleModalProvider',{{ $provider->id }},'Provider')" data-toggle="tooltip" data-placement="top"
                                           title="Editar proveedor">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('usuario delete')
                                        <a href="javascript:void(0)" class="btn btn-dark color-basic"
                                           onclick="Confirm({{ $provider->id }},'delprovider')" data-toggle="tooltip" data-placement="top"
                                           title="Eliminar proveedor">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    @endif
                </table>
            </div>

            {{ $providers->links() }}

{{--            @if (($codeSearch || $nameSearch || $stockSearch) && !$products->count())--}}
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
            @if (!$providers->count() && !$phoneSearch && !$nameSearch && !$rucSearch)
                <div>
                    No hay usuarios registradas. Registre nuevos usuarios pulsando el boton "+"
                </div>
            @endif
        </div>
    </div>
</div>

@push('modals')
    @livewire('admin.modal.provider.modal-provider')
@endpush

@push('scripts')
    <script>

        window.addEventListener('close-modal', event => {
            $('#ProviderModal').modal('hide');
        });
        window.addEventListener('open-modal', event => {
            $('#ProviderModal').modal('show');
        });

    </script>
@endpush
