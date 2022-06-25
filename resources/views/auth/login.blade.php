@extends('layouts.admin.login')
@section('title','Enetero Inicio sesión')
@section('content')

    <div class="login p-50">
        <h1 class="mb-2">ADMIN ENETERO</h1>
        <p>Bienvenido de nuevo, inicie sesión en su cuenta.</p>
        <form action="{{route('login')}}"  method="POST" class="mt-3 mt-sm-5">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="control-label">Email <span class="text-danger">*</span></label>
                        <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                     name="email" :value="old('email')" placeholder="Correo eléctronico" required />
                        <x-jet-input-error for="email"></x-jet-input-error>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="control-label">Password <span class="text-danger">*</span></label>
                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               placeholder="Contraseña" required autocomplete="current-password" >
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
                        </div>
                        <a href="{{route('password.request')}}" class="ml-auto">¿Olvidó su cotraseña?</a>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <button  type="submit" class="btn btn-primary text-uppercase">Iniciar sesión</button>
                </div>
                <div class="col-12  mt-3">
                    <p>¿No tienes una cuenta?<a href="{{route('register')}}"> Registrarme</a></p>
                </div>
            </div>
        </form>
    </div>

@endsection
