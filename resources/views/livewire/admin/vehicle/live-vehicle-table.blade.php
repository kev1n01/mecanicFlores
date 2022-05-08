<div>
    <nav aria-label="breadcrumb breadcrumb-custom">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehiculos</li>
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

            <button class="btn btn-dark color-basic" data-toggle="tooltip" data-placement="top" title="Limpiar filtros"
                    type="button" wire:click="clear">
                <i class="fas fa-eraser"></i><span> Limpiar</span>
            </button>

            @can('usuario create')
                <div class="btn-group mb-1">
                    <button type="button" class="btn btn-dark color-basic dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Crear
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" wire:click="$emit('toogleModalVehicle')"><i class="fas fa-plus"></i>Vehiculo</a>
                    </div>
                </div>
            @endcan
            <div class="btn-group mb-1">
                <button type="button" class="btn btn-dark color-basic dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    <i class="fas fa-file-excel"></i>
                    Exportar
                    @if ($selectedRows)
                        <span class="badge badge-default badge-color" >{{  count($selectedRows)  }}</span>
                    @endif
                </button>
                <div class="dropdown-menu" >
                    <a class="dropdown-item " href="#"><i class="fas fa-file-pdf"></i> PDF</a>
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
                            <input class="form-control" placeholder="placa" type="text" wire:model="plateSearch">
                        </th>

                        <th>
                            <input class="form-control" placeholder="año de modelo" type="text" wire:model="modelSearch">
                        </th>

                        <th>
                            <select class="form-control " wire:model="type_id">
                                <option value="">Seleciona tipo</option>
                                @foreach ($types as $key => $t)
                                    <option value="{{ $key }}">{{ $t }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th>
                            <select class="form-control " wire:model="brand_id">
                                <option value="">Seleciona marca</option>
                                @foreach ($brands as $key => $b)
                                    <option value="{{ $key }}">{{ $b }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th>
                            <select class="form-control " wire:model="color_id">
                                <option value="">Seleciona color</option>
                                @foreach ($colors as $key => $c)
                                    <option value="{{ $key }}">{{ $c }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th>
                            <select class="form-control " wire:model="customer_id">
                                <option value="">Seleciona cliente</option>
                                @foreach ($customers as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th class="text-center">
                            <span>
                                <i class="fas fa-filter"></i>
                                Filtrar por
                            </span>
                        </th>
                    </tr>

                    <thead class="thead-basic">
                    <tr>
                        <th>
                            <div class="icheck-primary" style="height: 15px">
                                <input wire:model="selectPageRows" type="checkbox" value="1" name="todo2"
                                       id="todoCheck2">
                                <label for="todoCheck2"></label>
                            </div>
                        </th>

                        <th class="table-th text-center" scope="col">Imagen</th>
                        <th width="10%" wire:click="sortable('license_plate')" class="th-pointer table-th text-center" scope="col">Placa
                            <span class=" th-span fas fa{{ $camp === 'license_plate' ? $icon : '-sort' }} "></span>
                        </th>
                        <th width="8%" wire:click="sortable('model_year')" class="th-pointer table-th text-center" scope="col">Año
                            <span class=" th-span fas fa{{ $camp === 'model_year' ? $icon : '-sort' }}"></span>
                        </th>

                        <th class="table-th text-center" scope="col">Tipo</th>
                        <th class="table-th text-center" scope="col">Marca</th>
                        <th class="table-th text-center" scope="col">Color</th>
                        <th width="15%" wire:click="sortable('customer_id')" class="th-pointer table-th text-center" scope="col">Cliente
                            <span class=" th-span fas fa{{ $camp === 'customer_id' ? $icon : '-sort' }}"></span>
                        </th>
                        <th class="table-th text-center" scope="col">Acciones</th>
                    </tr>
                    </thead>
                    @if ($vehicles->count())
                        <tbody>
                        @foreach ($vehicles as $ve)
                            <tr class="tr-custom">
                                <td style="width: 10px;">
                                    <div class="icheck-primary d-inline">
                                        <input wire:model="selectedRows" type="checkbox" value="{{ $ve->id }}"
                                               name="todo2" id="{{ $ve->id }}">
                                        <label for="{{ $ve->id }}"></label>
                                    </div>
                                </td>
                                <td width="8%">

                                    @php
                                        $images = App\Models\ImageVehicle::where('vehicle_plate', $ve->license_plate)
                                                ->limit(1)->get();
                                    @endphp
                                    @if($images)
                                        @foreach ($images as $img)
                                            <img src="{{asset('storage/vehicle-photos/'.$img->image)}}"
                                                 width="60px" height="60px" class="rounded-circle "
                                                 alt="{{$img->vehicle_plate}}">
                                        @endforeach
                                    @else
                                            <img src="{{asset('storage/'.$ve->image_vehicle)}}"
                                                 width="60px" height="60px" class="rounded-circle"
                                                 alt="{{$ve->license_plate}}">
                                    @endif
                                </td>
                                <td>{{ $ve->license_plate }}</td>
                                <td>{{ $ve->model_year }}</td>
                                <td>{{ $ve->type->type_vehicle }}</td>
                                <td>{{ $ve->brand->brand_vehicle }}</td>
                                <td>{{ $ve->color->color_vehicle }}</td>
                                <td>{{ $ve->customer->name }}</td>

                                <td width="12%">
                                    @can('usuario update')
                                        <a href="javascript:void(0)" class="btn btn-dark color-basic"
                                           wire:click="$emit('toogleModalVehicle',{{ $ve->id }},'Vehicle')" data-toggle="tooltip" data-placement="top"
                                           title="Editar producto">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('usuario delete')
                                        <a href="javascript:void(0)" class="btn btn-dark color-basic"
                                           onclick="Confirm({{ $ve->id }},'delvehicle')" data-toggle="tooltip" data-placement="top"
                                           title="Eliminar producto">
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

            {{ $vehicles->links() }}

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
{{--            @if (!$products->count() && !$codeSearch && !$nameSearch && !$stockSearch)--}}
{{--                <div>--}}
{{--                    No hay usuarios registradas. Registre nuevos usuarios pulsando el boton "+"--}}
{{--                </div>--}}
{{--            @endif--}}
        </div>
    </div>
</div>

@push('modals')
    @livewire('admin.modal.vehicle.modal-vehicle')
{{--    @livewire('admin.modal.vehicle.modal-brand-vehicle')--}}
{{--    @livewire('admin.modal.vehicle.modal-type-vehicle')--}}
@endpush

@push('scripts')
    <script>

        window.addEventListener('close-modal-vehicle', event => {
            $('#VehicleModal').modal('hide');
        });
        window.addEventListener('open-modal-vehicle', event => {
            $('#VehicleModal').modal('show');
        });
        window.addEventListener('open-modal-brand', event => {
            $('#BrandModal').modal('show');
        });
        window.addEventListener('close-modal-brand', event => {
            $('#BrandModal').modal('hide');
        });
        window.addEventListener('open-type-category', event => {
            $('#TypeModal').modal('show');
        });
        window.addEventListener('close-type-category', event => {
            $('#TypeModal').modal('hide');
        });


    </script>
    <script>
        {{--document.addEventListener('DOMContentLoaded',function (){--}}
        {{--    $('#select2').select2()--}}
        {{--    $('#select2').on('change',function (e){--}}
        {{--        var pId = $('#select2').select2("val")--}}
        {{--        @this.set('product_category_id',pId)--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endpush
