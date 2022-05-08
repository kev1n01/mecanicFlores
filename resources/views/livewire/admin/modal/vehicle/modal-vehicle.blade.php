<div>
    <form wire:submit.prevent="{{$method}}" enctype="multipart/form-data">
        <x-component-modal :idModal="$idModal" :action="$action" :nameComponent="$nameComponent"
                           :classModalDialog="$classModalDialog" :classSize="$classSize">

            <div class="row g-3">
                <div class="col-md-8">
                    <label for="customer_id" class="col-form-label"></label>

                    <select wire:model="customer_id" class="form-control select-custom select2" >
                        <option value="">Seleccione cliente</option>
                        @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('customer_id'))
                        <small style="color:red;">{{$errors->first('customer_id')}}</small>
                    @endif
                </div>

                <div class="col-md-4">
                    <x-component-input name="license_plate"  label="" placeholder="Ingresar placa" type="text"  ></x-component-input>
                </div>

                <div class="col-md-6">
                    <label for="type_id" class="col-form-label"></label>

                    <select wire:model="type_id" class="form-control select-custom" @if(!$customer_id)disabled="disabled"@else @endif>
                        <option value="">Seleccione tipo de vehiculo</option>
                        @foreach($types as $id => $type)
                            <option value="{{$id}}">{{$type}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('type_id'))
                        <small style="color:red;">{{$errors->first('type_id')}}</small>
                    @endif
                </div>

                <div class="col-md-6">
                    <label for="brand_id" class="col-form-label"></label>

                    <select wire:model="brand_id" class="form-control select-custom " @if(!$customer_id || !$type_id)disabled="disabled"@else @endif >
                        <option value="">Seleccione marca de vehiculo</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->brand_vehicle}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('brand_id'))
                        <small style="color:red;">{{$errors->first('brand_id')}}</small>
                    @endif
                </div>

                <div class="col-md-6">
                    <label for="color_id" class="col-form-label"></label>

                    <select wire:model="color_id" class="form-control select-custom" @if(!$customer_id || !$type_id)disabled="disabled"@else @endif >
                        <option value="">Seleccione color de vehiculo</option>
                        @foreach($colors as $id => $color)
                            <option value="{{$id}}">{{$color}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('color_id'))
                        <small style="color:red;">{{$errors->first('color_id')}}</small>
                    @endif
                </div>

                <div class="col-md-6">
                    <x-component-input name="model_year" label="" placeholder="Ingresar año de modelo" type="number"> </x-component-input>
                </div>

                <div class="col-md-6">
                    <x-component-input name="description" label="" placeholder="Ingresar descripcion" type="text"> </x-component-input>
                </div>

                <div class="col-md-6">
                    <label for="images" class="col-form-label"></label>

                    {{-- <x-component-input  id="formFile" name="image" label="" type="file" placeholder="Ingresar imagen"> </x-component-input> --}}
                    <input style="padding: 4px; " type="file" class="form-control"  wire:model="images" multiple="">

                    @if ($errors->has('images.*'))
                        <small style="color:red;">{{$errors->first('images.*')}}</small>
                    @endif

                </div>

                @if($method == 'updateTarget')
                        @if($imagesUpdate)
                            @if(!$images)
                                <div class="x_panel">
                                    <div class="x-title" >
                                        Imagenes actuales del vehiculo con placa <strong>{{$this->license_plate}}</strong>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="x_content" style="height:130px">
                                        <div class="row">
                                            @foreach($imagesUpdate as $image)
                                                <div class="col-md-55" style="height:150px">
                                                    <div class="thumbnail" style="height:150px">
                                                        <div class="image view view-first">
                                                            <img src="{{asset('storage/vehicle-photos/'.$image)}}" style="width: 100%; height: 100% ; display: block;">
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="x_panel">
                                <div class="x-title" >
                                    Imagenes cargadas para el vehiculo con placa <strong>{{$this->license_plate}}</strong>
                                    <button class="btn btn-danger btn-sm">Eliminar</button>
                                </div>
                                <div class="clearfix"></div>
                                <div class="x_content" style="height:130px">
                                    <div class="row">
                                        @foreach($images as $image)
                                            <div class="col-md-55" style="height:150px">
                                                <div class="thumbnail" style="height:150px">
                                                    <div class="image view view-first">
                                                        <img src="{{$image->temporaryURL()}}" style="width: 100%; height: 100%;  display: block;" >
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @elseif(!$images)
                            <div class="x_panel" width="85%" >
                                <h6 class="text-danger text-center">
                                    Este vehiculo no cuenta con imagenes
                                </h6>
                            </div>
                            @else
                            <div class="x_panel">
                                <div class="x-title" >
                                    Imagenes cargadas para el vehiculo con placa <strong>{{$this->license_plate}}</strong>
                                </div>
                                <div class="clearfix"></div>
                                <div class="x_content" style="height:130px">
                                    <div class="row">
                                        @foreach($images as $image)
                                            <div class="col-md-55" style="height:150px">
                                                <div class="thumbnail" style="height:150px">
                                                    <div class="image view view-first">
                                                        <img src="{{$image->temporaryURL()}}" style="width: 100%; height: 100%;  display: block;" >
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                @else
                    @if($images)
                        <div class="x_panel">
                            <div class="x-title" >
                                Imagenes cargadas para un nuevo vehiculo
                            </div>
                            <div class="clearfix"></div>
                            <div class="x_content" style="height:130px">
                                <div class="row">
                                    @foreach($images as $image)
                                        <div class="col-md-55" style="height:150px">
                                            <div class="thumbnail" style="height:150px">
                                                <div class="image view view-first">
                                                    <img src="{{$image->temporaryURL()}}" style="width: 100%; height: 100%;  display: block;" >
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @endif

                @endif


            </div>
        </x-component-modal>
    </form>
</div>
