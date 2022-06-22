<div>
    <form wire:submit.prevent="{{$method}}" >
        <x-component-modal :idModal="$idModal" :action="$action" :nameComponent="$nameComponent"
                           :classModalDialog="$classModalDialog" :classSize="$classSize">
            <div class="row g-3">
                <div class="col-md-6">
                    <x-component-input name="name" label="" placeholder="Nombre producto" type="text">
                    </x-component-input>
                </div>
                <div class="col-md-6">
                    <x-component-input name="code" label="" placeholder="Código de producto " type="text">
                    </x-component-input>
                </div>
                <div class="input-group col-md-6 mt-3">
                    @if($this->active_category_add )
                        <div class="form-group">
                            <input wire:model="category_name" id="category_name" type="text" class="form-control" placeholder="nombre categoria">
                        </div>
                        <span class="input-group-btn pl-2">
                        <button class="btn btn-dark" wire:click.prevent="addCategory"><i class="fa fa-floppy-disk"></i></button>
                        <button class="btn btn-danger" wire:click.prevent="cancelAddCategory"><i class="fa fa-xmark"></i></button>
                        </span>
                    @else
                        <div class="input-group-btn">
                            <button class="btn btn-success" wire:click.prevent="activeAddCategory"><i class="fa fa-plus"></i></button>
                        </div>
                        <label for="category_product_id" class="col-form-label"></label>
                        <select class="form-control custom-select @if($errors->has('category_product_id')) is-invalid @endif"
                                wire:model="category_product_id">
                            <option value="">Seleccion categoria</option>
                            @foreach($categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_product_id'))
                            <div class="invalid-feedback">{{$errors->first('category_product_id')}}</div>
                        @endif
                    @endif
                </div>

                <div class="input-group col-md-6 mt-3">

                    @if($this->active_brand_add )
                        <div class="form-group">
                            <input wire:model="brand_name" id="brand_name" type="text" class="form-control "placeholder="nombre marca">
                        </div>
                        <span class="input-group-btn pl-2">
                        <button class="btn btn-dark" wire:click.prevent="addBrand"><i class="fa fa-floppy-disk"></i></button>
                        <button class="btn btn-danger" wire:click.prevent="cancelAddBrand"><i class="fa fa-xmark"></i></button>
                        </span>
                    @else
                        <span class="input-group-btn">
                            <button class="btn btn-success" wire:click.prevent="activeAddBrands"><i class="fa fa-plus"></i></button>
                        </span>
                        <label for="brand_product_id" class="col-form-label"></label>
                        <select class="form-control custom-select @if($errors->has('brand_product_id')) is-invalid @endif"
                                wire:model="brand_product_id">
                            <option value="">Seleccion marca</option>
                            @foreach($brands as $key => $b)
                                <option value="{{$key}}">{{$b}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('brand_product_id'))
                            <div class="invalid-feedback">{{$errors->first('brand_product_id')}}</div>
                        @endif

                    @endif
                </div>
                <div class="input-group col-md-6 mt-3">
                    <label for="product_status_id" class="col-form-label"></label>
                    <select class="form-control custom-select @if($errors->has('product_status_id')) is-invalid @endif"
                                wire:model="product_status_id">
                            <option value="">Seleccion estado</option>
                            @foreach($status as $key => $s)
                                <option value="{{$key}}">{{$s}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('product_status_id'))
                            <div class="invalid-feedback">{{$errors->first('product_status_id')}}</div>
                        @endif
                </div>

                <div class=" col-md-6">
                    <x-component-input name="stock" label="" placeholder="stock " type="text">
                    </x-component-input>
                </div>
                <div class="col-md-6">
                    <x-component-input name="sale_price" label="" placeholder="precio venta " type="text">
                    </x-component-input>
                </div>
                <div class="col-md-6">
                    <x-component-input name="purchase_price" label="" placeholder="precio compra " type="text">
                    </x-component-input>
                </div>
                <div class="col-md-6">
                    <x-component-input name="unit" label="" placeholder="Unidad de medida " type="text">
                    </x-component-input>
                </div>
                <div class="col-md-6">
                    <x-component-input-file name="image_product" label="Elige imagen">
                    </x-component-input-file>

                    <div class="col-md-4 pt-3 pl-1 pr-8 pb-1 ">
                        @if($this->method == 'updateTarget' )
                            @if($image_product)
                                <img src="{{ $image_product->temporaryURL() }}" width="100px" height="100px"
                                     class="rounded-circle">
                            @else
                                @if($image_update)
                                    <img src="{{ asset('storage/'.$image_update) }}" width="100px" height="100px"
                                         class="rounded-circle" alt="{{ $name }}">
                                @elseif($image_url)
                                    <img src="{{ asset('storage/'.$image_url) }}" width="100px" height="100px"
                                         class="rounded-circle" alt="{{ $name }}">
                                @endif
                            @endif

                        @else
                            @if($image_product )
                                <img src="{{ $image_product->temporaryURL() }}" width="100px" height="100px"
                                     class="rounded-circle">
                            @endif
                        @endif
                    </div>
                </div>


            </div>
        </x-component-modal>
    </form>
</div>
