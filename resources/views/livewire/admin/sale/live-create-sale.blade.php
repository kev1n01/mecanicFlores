<div>
    <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
                <h6 class="pb-1 mb-0"> <strong>Selección del cliente</strong></h6>
            <div class="form-row mb-2">
                <div class="col">
                    <select wire:model="customer_id" class="form-control " >
                        <option value="">------ Seleccione ------</option>
                        @foreach($customers as $c)
                            <option value="{{$c->id}}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Dni o Ruc" disabled wire:model="identidad_customer">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Celular"  disabled wire:model="phone_customer">
                </div>
            </div>
            <hr>
            <h6 class="pb-1 mb-0"> <strong>Búsqueda del producto</strong></h6>
            <div class="form-row mb-2">
                <div class="col">
                    <input type="text" id="barcode" wire:keydown.enter.prevent="$emit('scan-code',$('#barcode').val())"
                           class="form-control" placeholder="Ingresar código" autofocus>
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Categoria" disabled wire:model="product_category">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Marca" disabled wire:model="product_brand">
                </div>
            </div>

            {{--DETALLES--}}
            <hr>
            <h6 class="pb-1 mb-0"> <strong>Lista de productos añadidos</strong></h6>
            <div class="connect-sorting">
                <div class="connect-sorting-content">
                    <div class="card simple-title-task ui-sortable-handle">
                        <div class="card-body">
                            @if($total > 0)
                            <div class="table-responsive tblscroll">
                                <table class="table  table-striped mt-1">
                                    <thead class="text-white" style="background-color: #2A3F54; ;">
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
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <button wire:click.prevent="decreaseQty({{ $item->id }})" class="btn btn-dark mbmobile">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button wire:click.prevent="increaseQty({{ $item->id }})" class="btn btn-dark mbmobile">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <h6 class="text-center text-muted">Agrega productos al carrito de venta</h6>
                            @endif

                            <div wire:loading.inline wire:target="saveSale">
                                <h4 class="text-danger text-center">Guardando venta..</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-12 col-md-4">
            {{--TOTAL--}}
            <div class="row">
                <div class="col-sm-12">
                    <div>
                        <div class="connect-sorting">
                            <h5></h5>
                            <div class="connect-sorting-content">
                                <div class="card simple-title-task ui-sortable-handle">
                                    <div class="card-body">
                                        <div class="task-header text-center">
                                            <div>
                                                <h2>TOTAL: S/{{ number_format($total,2) }}</h2>
                                                <input type="hidden" id="hiddenTotal" value="{{$total}}">
                                            </div>

                                            <div>
                                                <h2 class="mt-3">Articulos: {{$itemsQuantity}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--DENOMINACIONES--}}
            <div class="row mt-3">
                <div class="col-sm-12">
                    <div class="connect-sorting">
                        <h5></h5>
                        <div class="container">
                            <div class="row">
                                @foreach($denominations as $d)
                                <div class="col-sm-4 mt-2">
                                    <button wire:click="ACash({{ $d->value }})" class="btn btn-dark btn-block den">
                                        {{ $d->value > 0 ? 'S/' . number_format($d->value,2,'.', '') : 'Exacto' }}
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="connect-sorting-content mt-4">
                            <div class="card simple-title-task ui-sortable-handle">
                                <div class="card-body">

                                <div class="input-group input-group-md mb-3">
                                    <div class="input-group-prepend">
                                        <span style="background: #2A3F54; color: white; height: 85%; font-size: .8rem;"
                                              class=" input-group-text input-gp hideonsm">
                                            EFECTIVO (F8)
                                        </span>
                                    </div>
                                    <input type="number" id="cash" wire:model="efectivo" class="form-control text-center"
                                    value="{{ $efectivo }}">
                                    <div class="input-group-append">
                                        <span wire:click="clearEfectivo" class=" th-pointer input-group-text" style="background: #2A3F54; color: white;  height: 85%; font-size: 1rem; ">
                                            <i class="fas fa-backspace fa-2x"></i>
                                        </span>
                                    </div>
                                </div>

                                <h5 class="text-muted" >Cambio: S/{{number_format($change,2)}}</h5>

                                <div class="row justify-content-between mt-5">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        @if($total > 0)
                                        <button onclick="ConfirmCancelSale('clearCart','¿Seguro de eliminar el carrito?')" class="btn btn-dark mtmobile btn-sm">
                                            CANCELAR (F4)
                                        </button>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        @if($efectivo >= $total && $total >0)
                                        <button wire:click.prevent="saveSale" class="btn btn-dark btn-md btn-block btn-sm">GUARDAR (F9)</button>
                                        @endif
                                    </div>
                                </div>
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
                placeholder: 'Selecciona un cliente'
            });

        });
        function ConfirmCancelSale(event,text)
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
