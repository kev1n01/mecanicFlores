 <!-- Modal Login -->
        <div style="top: 180px !important;" class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="modaltilogin" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="text-center" id="modaltilogin">Iniciar Sesión</h4>
                        <form action="{{route('login')}}"  method="POST" >
                            @csrf
                            <div class="container-fluid">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="control-label">Email <span class="text-danger">*</span></label>
                                        <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                                     name="email" :value="old('email')"  autofocus autocomplete="email"/>
                                        <x-jet-input-error for="email"></x-jet-input-error>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="control-label">Password <span class="text-danger">*</span></label>
                                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                              required autocomplete="current-password" >
                                        <x-jet-input-error for="password"></x-jet-input-error>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-block d-sm-flex  align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck" name="remember">
                                            <label class="form-check-label" for="gridCheck">
                                                Recordarme
                                            </label>
                                        <a href="{{route('password.request')}}" class="p-5">¿Olvidó su cotraseña?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button  type="submit" class="btn btn-primary text-uppercase">Iniciar sesión</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

