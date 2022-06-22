<div>
    <form wire:submit.prevent="{{$method}}" >
        <x-component-modal :idModal="$idModal" :action="$action" :nameComponent="$nameComponent"
                           :classModalDialog="$classModalDialog" :classSize="$classSize">
            <div class="row g-3">
                <div class="col-md-6">
                    <x-component-input name="name" label="" placeholder="Nombre proveedor" type="text">
                    </x-component-input>
                </div>
                <div class=" col-md-6">
                    <x-component-input name="ruc" label="" placeholder="Ruc" type="text">
                    </x-component-input>
                </div>
                <div class="col-md-6">
                    <x-component-input name="phone" label="" placeholder="Número telefónico" type="text">
                    </x-component-input>
                </div>
                <div class="input-group col-md-6 mt-3">
                    <label for="provider_status_id" class="col-form-label"></label>
                    <select class="form-control custom-select @if($errors->has('provider_status_id')) is-invalid @endif"
                            wire:model="provider_status_id">
                        <option value="">Seleccion estado</option>
                        @foreach($status as $key => $s)
                            <option value="{{$key}}">{{$s}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('provider_status_id'))
                        <div class="invalid-feedback">{{$errors->first('provider_status_id')}}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <x-component-input name="address" label="" placeholder="Dirección" type="text">
                    </x-component-input>
                </div>

                <div class="col-md-6">
                    <x-component-input name="name_company" label="" placeholder="Nombre compañia" type="text">
                    </x-component-input>
                </div>
                <div class="col-md-6">
                    <x-component-input-file name="image" label="Elige imagen">
                    </x-component-input-file>

                    <div class="col-md-4 pt-3 pl-1 pr-8 pb-1 ">

                        @if($this->method == 'updateTarget' )
                            @if($image)
                                <img src="{{ $image->temporaryURL() }}" width="100px" height="100px"
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
                            @if($image)
                                <img src="{{ $image->temporaryURL() }}" width="100px" height="100px"
                                 class="rounded-circle">
                            @endif
                        @endif
                    </div>
                </div>


            </div>
        </x-component-modal>
    </form>
</div>
