<div>
    <nav aria-label="breadcrumb breadcrumb-custom">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
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
                                <a class="dropdown-item" wire:click="$emit('toogleModalProduct')">Producto</a>
                                <a class="dropdown-item" wire:click="$emit('toogleModalBrand')">Marca</a>
                                <a class="dropdown-item" wire:click="$emit('toogleModalCategory')"> Categoria</a>
                            </div>
                        </div>
                    @endcan
                    <div class="btn-group mb-1">
                        <button type="button" class="btn btn-dark color-basic dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <i class="fas fa-file-excel"></i>
                            Exportar
                            @if ($selectedRows)
                                <span class="badge badge-default" style="background-color: white; color: #0f0f0f;" >{{  count($selectedRows)  }}</span>
                            @endif
                        </button>
                        <div class="dropdown-menu" >
                            <a class="dropdown-item " href="{{ route('products.pdf') }}"><i class="fas fa-file-pdf"></i> PDF</a>
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
                <table class="table table-striped">
                    <tr>
                        <th></th>
                        <th></th>

                        <th>
                            <input class="form-control" placeholder="code" type="text" wire:model="codeSearch">
                        </th>

                        <th>
                            <input class="form-control" placeholder="nombre" type="text" wire:model="nameSearch">
                        </th>

                        <th>
                            <input class="form-control" placeholder="stock" type="text"
                                   wire:model="stockSearch">
                        </th>

                        <th>
                            <select class="form-control " wire:model="product_status_id">
                                <option value="">Seleciona estado</option>
                                @foreach ($status as $key => $statu)
                                    <option value="{{ $key }}">{{ $statu }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <select id="select2" class="form-control " wire:model="product_category_id">
                                <option value="">Seleciona categoria</option>
                                @foreach ($categories as $key => $category)
                                    <option value="{{ $key }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th>
                            <select class="form-control " wire:model="product_brand_id">
                                <option value="">Seleciona marca</option>
                                @foreach ($brands as $key => $brand)
                                    <option value="{{ $key }}">{{ $brand }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th class="text-center">
                            <span>
                                <i class="ti ti-filter"></i>
                                Filtrar por
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
                        <th width="60px" wire:click="sortable('code')" class="th-pointer table-th text-center" scope="col">Código
                            <span class=" th-span fa fa{{ $camp === 'code' ? $icon : '-sort' }} "></span>
                        </th>
                        <th wire:click="sortable('name')" class="th-pointer table-th text-center" scope="col">Nombre
                            <span class=" th-span fa fa{{ $camp === 'name' ? $icon : '-sort' }}"></span>
                        </th>

                        <th width="10%"  wire:click="sortable('stock')" class="th-pointer table-th text-center" scope="col">Stock
                            <span class=" th-span fa fa{{ $camp === 'stock' ? $icon : '-sort' }}"></span>
                        </th>

                        <th class="table-th text-center" scope="col">Estado</th>
                        <th class="table-th text-center" scope="col">Categoria</th>
                        <th class="table-th text-center" scope="col">Marca</th>

                        <th class="table-th text-center" scope="col">Acciones</th>
                    </tr>
                    </thead>
                    @if ($products->count())
                        <tbody>
                        @foreach ($products as $product)
                            <tr class="">
                                <th style="width: 10px;">
                                    <div class="icheck-primary d-inline">
                                        <input wire:model="selectedRows" type="checkbox" value="{{ $product->id }}"
                                               name="todo2" id="{{ $product->id }}">
                                        <label for="{{ $product->id }}"></label>
                                    </div>
                                </th>

                                <td>
                                    <img src="{{ asset('storage/'.$product->image_product) }}" width="60px" height="60px"
                                         class="rounded-circle" alt="{{ $product->name }}">
                                </td>
                                <td>{{ $product->code }}</td>
                                <td>{{ substr($product->name,0,20) }}</td>
                                <td class="th-pointer text-center {{$product->stock <= 18 ? 'table-danger' : 'table-success'}}" wire:click="addProductToPurchase({{$product->id}})" >{{ $product->stock }}</td>
                                <td>
                                    <h6>
                                        <span class=" badge {{ $product->product_status_id == 1 ? 'badge-success-inverse ' : 'badge-danger-inverse'}}">
                                            {{ strtoupper( $product->status_name)}}
                                        </span>
                                    </h6>
                                </td>
                                <td>{{ $product->category_product->name }}</td>
                                <td>{{ substr($product->brand_product->name,0,10)}}</td>

                                <td width="12%">
                                    @can('usuario update')
                                        <a href="javascript:void(0)" class="btn btn-dark color-basic"
                                           wire:click="$emit('toogleModalProduct',{{ $product->id }},'Product')" data-toggle="tooltip" data-placement="top"
                                           title="Editar producto">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('usuario delete')
                                        <a href="javascript:void(0)" class="btn btn-dark color-basic"
                                           onclick="Confirm({{ $product->id }},'delproduct')" data-toggle="tooltip" data-placement="top"
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

            {{ $products->links() }}

            @if (($codeSearch || $nameSearch || $stockSearch) && !$products->count())
                <div>
                    No hay resultados para la búsqueda "
                    @if ($nameSearch)
                        {{ $nameSearch }}
                    @endif
                    @if ($codeSearch)
                        {{ $codeSearch }}
                    @endif
                    @if ($stockSearch)
                        {{ $stockSearch }}
                    @endif
                    " en la página {{ $page }} al mostrar {{ $perPage }} registros
                </div>
            @endif
            @if (!$products->count() && !$codeSearch && !$nameSearch && !$stockSearch)
                <div>
                    No hay usuarios registradas. Registre nuevos usuarios pulsando el boton "+"
                </div>
            @endif
        </div>
    </div>
</div>

@push('modals')
    @livewire('admin.modal.product.modal-product')
    @livewire('admin.modal.brand.modal-brand')
    @livewire('admin.modal.category.modal-category')
@endpush

@push('scripts')
    <script>

        window.addEventListener('close-modal', event => {
            $('#ProductModal').modal('hide');
        });
        window.addEventListener('open-modal', event => {
            $('#ProductModal').modal('show');
        });
        window.addEventListener('open-modal-brand', event => {
            $('#BrandModal').modal('show');
        });
        window.addEventListener('close-modal-brand', event => {
            $('#BrandModal').modal('hide');
        });
        window.addEventListener('open-modal-category', event => {
            $('#CategoryModal').modal('show');
        });
        window.addEventListener('close-modal-category', event => {
            $('#CategoryModal').modal('hide');
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
