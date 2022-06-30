@section('title','Carrito Enetero')
<div>
    <div class="container" style="padding-top: 50px; !important;">
        <div class="page-cart">
            <div class="table-responsive">
                <table class="cart-summary table table-bordered">
                    <thead>
                    <tr>
                        <th class="width-20">Acción</th>
                        <th class="width-80 text-center">Imagen</th>
                        <th class="width-50 text-center">Nombre</th>
                        <th class="width-100 text-center">Precio Unidad</th>
                        <th class="width-100 text-center">Cantidad</th>
                        <th class="width-100 text-center">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $c)
                    <tr>
                        <td class="product-remove">
                            <span wire:click.prevent="removeItem({{ $c->id }})" class="remove" >
                                <i class="fa fa-trash"></i>
                            </span>
                        </td>
                        <td>
                            @if(count($c->attributes) > 0)
                                <img src="{{asset('storage/'.$c->attributes[0])}}" alt="{{$c->name}}" height="60"
                                     width="80" class="img-responsive">
                            @endif

                        </td>
                        <td>
                            <p class="product-name">{{$c->name}}</p>
                        </td>
                        <td class="text-center">
                            S/{{ number_format($c->price ,2)}}
                        </td>
                        <td>
                            <div class="product-quantity">
                                <div class="qty">
                                    <div class="input-group">
                                        <input type="number" id="r{{$c->id}}"
                                               wire:change="updateQuantity({{ $c->id }}, $('#r' + {{ $c->id }}).val())"
                                               value="{{$c->quantity}}">
                                        <span class="adjust-qty" >
                                            <span class="adjust-btn plus" wire:click.prevent="increaseQty({{ $c->id }})">+</span>
                                            <span class="adjust-btn minus" wire:click.prevent="decreaseQty({{ $c->id }})">-</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            S/ {{number_format($c->price * $c->quantity,2)}}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                        <tr class="cart-total">
                            <td rowspan="3" colspan="3"></td>
                            <td colspan="2" class="total text-right">Total</td>
                            <td colspan="1" class="total text-center">S/{{ number_format($total,2) }}</td>
                        </tr>

                        <tr class="cart-total">
                        </tr>

                    </tfoot>
                </table>
            </div>

            <div class="checkout-btn">
                <span  class="btn btn-primary pull-right" wire:click.prevent="saveSale">
                    <span>Comprar</span>
                    <i class="fa fa-angle-right ml-xs"></i>
                </span>
            </div>
            <div class="checkout-btn pr-2">
                <span  class="btn btn-secondary pull-right" wire:click.prevent="clearCart">
                    <span>Vaciar carrito</span>
                </span>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('open-modal-login', event => {
            $('#ModalLogin').modal('show');
        });
    </script>
@endpush
