<div>
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-md-7">

                            <div class="input-group mb-3">
                                <input type="text" wire:model="search" class="form-control"
                                       placeholder="Buscar productos">

                                <div class="input-group-append">
                                    <button class="btn btn-outline-success" type="button" wire:click="resetSearch()">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>



                            <div id="table-products" class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Imagen</th>
                                        <th>Producto</th>
                                        <th>Unidad</th>
                                        <th>Costo Por Unidad</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($products as $product)
                                        <tr>
                                            <td scope="row">{{$product->id}}</td>
                                            <td>
                                                <img src="{{asset('storage/'.$product->image_product)}}"
                                                     class="img-fluid" width="35" alt="{{$product->name}}">
                                            </td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->unit}}</td>
                                            <td>{{$product->purchase_price}}</td>
                                            <td>
                                                <button type="button"  wire:click="addToCart({{$product->id}})" class="btn btn-info">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="col-md-5">

                            <button type="button" wire:click="clearCart" class="btn btn-warning btn-block"><i class="fas fa-sync-alt"></i>
                                Limpiar productos</button>

                            <div id="table-cart" class="table-responsive mt-2">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cant.</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($cart_content as $content)
                                        <tr>
                                            <th scope="row">{{$content->id}}</th>

                                            <td>
                                                <img src="{{asset('storage/'.$content->attributes[0])}}"
                                                     class="img-fluid" width="35" alt="product">
                                            </td>
                                            <td>{{$content->name}}</td>

                                            <td class="text-center">
                                                <div class="m-btn-group m-btn-group--pill btn-group mr-2"
                                                     role="group" aria-label="...">

                                                    <button type="button"
                                                            wire:click="quantityMinus({{$content->id}})"
                                                            class="m-btn btn btn-default">
                                                        <i class="fa fa-minus"></i>
                                                    </button>

                                                    <button type="button" class="m-btn btn btn-default" disabled>
                                                        {{$content->quantity}}
                                                    </button>

                                                    <button type="button"
                                                            wire:click="quantityPlus({{$content->id}})"
                                                            class="m-btn btn btn-default">
                                                        <i class="fa fa-plus"></i>
                                                    </button>

                                                </div>
                                            </td>


                                            <td>S/{{$content->price}}</td>

                                            <td>

                                                <button type="button" wire:click="removeItem({{$content->id}})"
                                                        class="btn btn-danger">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group mt-2">
                                <label class="font-weight-bold h5 float-right">Total: S/{{ number_format(($total),2)}}</label>
                            </div>

                            <div class="form-group mt-4">
                                <label for="">Proveedores</label>
                                <select wire:model="provider" class="form-control @error('provider') is-invalid @enderror" name="" id="">
                                    <option value="select">Selecciona un proveedor</option>
                                    @foreach ($providers as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('provider')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Estado de compra</label>
                                <select wire:model="status_id" class="form-control @error('status_id') is-invalid @enderror" name="" id="">
                                    <option value="select">Selecciona un proveedor</option>
                                    @foreach ($status as $key => $statu)
                                        <option value="{{$key}}">{{$statu}}</option>
                                    @endforeach
                                </select>
                                @error('status_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Codigo de factura</label>
                                <input type="text" wire:model.lazy="invoice_code"  disabled class="form-control @error('invoice_code') is-invalid @enderror" >
                                @error('invoice_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de compra </label>

                                <input type="date" wire:model.lazy="date_purchase"  value=""  class="form-control @error('date_purchase') is-invalid @enderror">
                                @error('date_purchase')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
{{--                            <div class="col-md-6">--}}
{{--                                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">--}}
{{--                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>--}}
{{--                                    <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <textarea  wire:model.lazy="observation" name="" id="" class="form-control @error('observation') is-invalid @enderror">
                                </textarea>
                                @error('observation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <button wire:click="savePurchase()" class="btn btn-primary btn-lg btn-block" type="button">
                                        <i class="fas fa-share"></i> Guardar
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button wire:click="cancelPurchase()" class="btn btn-secondary btn-lg btn-block" type="button">
                                        <i class="far fa-times-circle"></i> Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

@push('styles')

    <style type="text/css">
        #table-products {
            height: 637px;
        }
        #table-cart {
            height: 400px;
        }
    </style>
@endpush
@push('scripts')

        <script>
            $(document).ready(function() {
                $('#select2').select2({
                    placeholder: 'Seleccion una opcion'
                });
            })
        </script>
@endpush
