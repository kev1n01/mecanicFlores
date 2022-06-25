<div>
    <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="card-body">
                <h6 class="pb-1 mb-0"> <strong>Información del proveedor</strong></h6>
                <div class="form-row mb-2">
                    <div class="col">
                        <select wire:model="provider_id" class="form-control " >
                            <option value="">------Seleccione-------</option>
                            @foreach($providers as $p)
                                <option  value="{{$p->id}}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Ruc" disabled wire:model="ruc_provider">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Celular" disabled wire:model="phone_provider">
                    </div>
                </div>
                <h6 class="pb-1 mb-0"> <strong>Información de la compra</strong></h6>
                <div class="form-row mb-2">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Código" disabled wire:model="code_purchase">
                    </div>
                    <div class="col">
                        <input type="date" class="form-control " placeholder="Fecha" wire:model="date_purchase"
                               @if(!$provider_id) disabled @endif >
                    </div>
                    <div class="col">
                        <select wire:model="status_id" class="form-control" @if(!$provider_id) disabled @endif >
                            <option value="">------Seleccione estado-------</option>
                            @foreach($status as $key => $s)
                                <option  value="{{$key}}">{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                {{-- input autocomplete --}}
                    <h6 class="pb-1 mb-0"> <strong>Búsqueda de productos</strong></h6>
                <div class="input-group mb-3">
                    <input type="text" wire:model="search" class="form-control"
                           placeholder="Buscar...">
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="button" wire:click="resetSearch()" >
                            <i class="fa fa-eraser"></i >
                        </button>
                    </div>
                </div>
                    <h6 class="pb-1 mb-0"> <strong>Productos para compra</strong></h6>
                <div class="table-responsive tblscroll">
                    <table class="table  table-striped mt-1">
                        <thead class="text-white" style="background-color: #2A3F54; ">
                        <tr>
                            <th>Código</th>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($products as $product)
                            <tr>
                                <td scope="row">{{$product->code}}</td>
                                <td>
                                    <img src="{{asset('storage/'.$product->image_product)}}"
                                         class="img-fluid" width="35" alt="{{$product->name}}">
                                </td>
                                <td>{{$product->name}}</td>
                                <td>
                                    <button type="button"  wire:click="addToCart({{$product->code}})" class="btn btn-dark">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                {{ $products->links() }}
                {{--DETALLES--}}
                <hr>
                <h6 class="pb-1 mb-0"> <strong>Productos agregados para compra</strong></h6>
                    @if($total > 0)
                        <div class="table-responsive tblscroll">
                            <table class="table table-striped mt-1">
                                <thead class="text-white" style="background-color: #2A3F54 ;">
                                <tr>
                                    <th width="10%"></th>
                                    <th class="table-th">Descripción</th>
                                    <th class="table-th text-center">Precio</th>
                                    <th width="13%" class="table-th text-center">Cantidad</th>
                                    <th class="table-th text-center">Importe</th>
                                    <th class="table-th text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $item)
                                    <tr>
                                        <td class="text-center table-th">
                                            @if(count($item->attributes) > 0)
                                                <img src="{{asset('storage/'.$item->attributes[0])}}" alt="{{$item->name}}" height="60"
                                                     width="60" class="rounded">
                                            @endif
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">S/{{ number_format($item->price ,2)}}</td>
                                        <td>
                                            <input type="number" id="r{{$item->id}}"
                                                   wire:change="updateQuantity({{ $item->id }}, $('#r' + {{ $item->id }}).val())"
                                                   style="font-size: 1rem !important;" class="form-control text-center" value="{{$item->quantity}}">
                                        </td>
                                        <td class="text-center"><p>S/ {{number_format($item->price * $item->quantity,2)}}</p></td>
                                        <td class="text-center">
                                            <button wire:click.prevent="removeItem({{ $item->id }})" class="btn btn-dark mbmobile">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <button wire:click.prevent="decreaseQty({{ $item->id }})" class="btn btn-dark mbmobile">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <button wire:click.prevent="increaseQty({{ $item->id }})" class="btn btn-dark mbmobile">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    @else
                        <div style="background-color: rgba(230,230,230,0.8); height: 50px;">
                            <h6 class="text-center mt-0 pt-3">Agrega productos para actualizar stock</h6>
                        </div>
                    @endif

                    <div wire:loading.inline wire:target="savePurchase">
                        <h4 class="text-primary text-center">Guardando Compra..</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            {{--TOTAL--}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class=" text-center">
                                <div class="input-group input-group-md mb-3">
                                    <div class="input-group-prepend">
                                        <span style="background: #2A3F54; color: white; height: 101%; font-size: .8rem;"
                                              class=" input-group-text input-gp ">Comprador
                                        </span>
                                    </div>
                                    <input type="text" disabled class="form-control text-center" value="{{ Auth::user()->name }}">
                                </div>
                                <div>
                                    <h2>TOTAL: S/{{ number_format($total,2) }}</h2>
                                    <input type="hidden" id="hiddenTotal" value="{{$total}}">
                                </div>
                                <div>
                                    <h2 class="mt-3">Articulos: {{$itemsQuantity}}</h2>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <textarea  wire:model.lazy="observation" class="form-control">
                                </textarea>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    @if($total > 0)
                                        <button onclick="ConfirmCancelPurchase('clearCart','¿Seguro de eliminar el carrito?')"
                                                class="btn btn-dark  btn-sm">
                                            CANCELAR (F4)
                                        </button>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <button wire:click.prevent="savePurchase"
                                            class="btn btn-dark btn-md btn-block btn-sm">GUARDAR (F9)</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

    <script>
        $(document).ready(function(){
            $('.select2').select2({
                placeholder: 'Selecciona un proveedor'
            });

        });
        function ConfirmCancelPurchase(event,text)
        {
            Swal.fire({
                title: 'CONFIRMAR',
                text: text,
                icon: 'warning',
                iconColor: '#1ABB9C',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#9d9c9c',
                confirmButtonColor: '#383F5C',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if(result.value) {
                    window.livewire.emit(event)
                    Swal.close()
                }
            })
        }

        document.addEventListener('DOMContentLoaded', function () {
            livewire.on('scan-code',action => {
                $('#barcode').val('')
            })
            window.livewire.on('print_ticket', saleId => {
                window.open("print://" + saleId, '_blank')
            })
        });

    </script>
@endpush
