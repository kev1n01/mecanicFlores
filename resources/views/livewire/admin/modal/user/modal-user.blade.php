<div>
    <form wire:submit.prevent="{{$method}}" >
        <x-component-modal :idModal="$idModal" :action="$action" :nameComponent="$nameComponent"
            :classModalDialog="$classModalDialog" :classSize="$classSize">
            <div class="row g-3">
                <div class="col-md-6">
                    <x-component-input name="name" label="" placeholder="Ingresar nombre" type="text">
                    </x-component-input>
                </div>
                <div class="col-md-6">
                    <x-component-input name="email" label="" placeholder="Ingresar correo" type="email">
                    </x-component-input>
                </div>
                <div class="col-md-6">
                    <x-component-select
                        :options="$roles"
                        name="role"
                        placeholder="Seleccione un rol"
                        label="">
                    </x-component-select>
                </div>
                <div class="col-md-6">
                    <x-component-select
                        :options="$status"
                        name="user_status_id"
                        placeholder="Seleccione un estado"
                        label="">
                    </x-component-select>
                </div>
                @if($action == 'Registrar')
                <div class="col-md-6">
                    <x-component-input name="password" label="" placeholder="Ingresar su contraseña" type="password">
                    </x-component-input>
                </div>
                <div class="col-md-6">
                    <x-component-input name="password_confirmation" label="" placeholder="Confirmar contraseña"
                        type="password">
                    </x-component-input>
                </div>
                @endif
                <div class="col-md-6">
                    <x-component-input-file name="profile_photo_path" label="Elegir imagen de usuario">
                    </x-component-input-file>

                    <div class="col-md-4 pt-3 pl-1 pr-8 pb-1">
                        @if($this->method == 'actualizar' )
                            @if($profile_photo_path)
                                <img src="{{ $profile_photo_path->temporaryURL() }}" width="100px" height="100px"
                                     class="rounded-circle">
                            @else
                                @if($profile_photo_path_update)
                                    <img src="{{ asset('storage/'.$profile_photo_path_update) }}" width="100px" height="100px"
                                         class="rounded-circle" alt="{{ $name }}">
                                @elseif($profile_photo_url)
                                    <img src="{{ asset($profile_photo_url) }}" width="100px" height="100px"
                                         class="rounded-circle" alt="{{ $name }}">
                                @endif
                            @endif

                        @else
                            @if($profile_photo_path )
                                <img src="{{ $profile_photo_path->temporaryURL() }}" width="100px" height="100px"
                                     class="rounded-circle">
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </x-component-modal>
    </form>
</div>
