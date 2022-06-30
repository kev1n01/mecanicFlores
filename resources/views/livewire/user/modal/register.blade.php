<!-- Modal Register -->
<div style="top: 180px !important;" class="modal fade" id="ModalRegister" tabindex="-1" role="dialog" aria-labelledby="modaltiregister" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="text-center" id="modaltiregister">Crear una cuenta</h4>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div  style="padding-bottom: 10px;"  class="mb-3">
                        <label class="control-label">Nombres <span class="text-danger">*</span></label>
                        <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                     :value="old('name')"  required autofocus autocomplete="name" />
                        <x-jet-input-error for="name"></x-jet-input-error>
                    </div>
                    <div  style="padding-bottom: 10px;"  class="mb-3">
                        <label class="control-label">Email <span class="text-danger">*</span></label>
                        <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                     :value="old('email')"  required/>
                        <x-jet-input-error for="email"></x-jet-input-error>
                    </div>
                    <div  style="padding-bottom: 10px;"  class="mb-3">
                        <label class="control-label">Contraseña <span class="text-danger">*</span></label>
                        <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                     name="password"  autocomplete="new-password" required/>
                        <x-jet-input-error for="password"></x-jet-input-error>
                    </div>
                    <div  style="padding-bottom: 10px;"  class="mb-3">
                        <label class="control-label">Confirmar contraseña <span class="text-danger">*</span></label>
                        <x-jet-input class="form-control" type="password" name="password_confirmation"  autocomplete="new-password" />
                    </div>
                    <div  style="padding-bottom: 10px;"  class="mb-3">
                        <label class="control-label">Ruc</label>
                        <x-jet-input class="form-control" type="text" name="ruc"  required/>
                        <x-jet-input-error for="ruc"></x-jet-input-error>
                    </div>
                    <div  style="padding-bottom: 10px;"  class="mb-3">
                        <label class="control-label">Dni</label>
                        <x-jet-input class="form-control" type="text" name="dni"  required/>
                        <x-jet-input-error for="dni"></x-jet-input-error>
                    </div>
                    <div  style="padding-bottom: 10px;"  class="mb-3">
                        <label class="control-label">Celular </label>
                        <x-jet-input class="form-control" type="text" name="phone" required />
                        <x-jet-input-error for="phone"></x-jet-input-error>
                    </div>
                    <div  style="padding-bottom: 10px;"  class="mb-3">
                        <label class="control-label">Dirección </label>
                        <x-jet-input class="form-control" type="text" name="address"  />
                        <x-jet-input-error for="address"></x-jet-input-error>

                    </div>
                    <div class="d-flex justify-content-end align-items-baseline">
                        <div class="col-12 mt-3">
                            <button  type="submit" class="btn btn-primary text-uppercase">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

