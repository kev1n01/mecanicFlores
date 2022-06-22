{{--<x-guest-layout>--}}

{{--        <x-jet-authentication-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <x-jet-authentication-card-logo />--}}
{{--        </x-slot>--}}

{{--        <div class="card-body">--}}

{{--            <x-jet-validation-errors class="mb-3 rounded-0" />--}}

{{--            @if (session('status'))--}}
{{--                <div class="alert alert-success mb-3 rounded-0" role="alert">--}}
{{--                    {{ session('status') }}--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            <form method="POST" action="{{ route('login') }}">--}}
{{--                @csrf--}}
{{--                <div class="mb-3">--}}
{{--                    <x-jet-label value="{{ __('Email') }}" />--}}

{{--                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"--}}
{{--                                 name="email" :value="old('email')" required />--}}
{{--                    <x-jet-input-error for="email"></x-jet-input-error>--}}
{{--                </div>--}}

{{--                <div class="mb-3">--}}
{{--                    <x-jet-label value="{{ __('Password') }}" />--}}

{{--                    <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"--}}
{{--                                 name="password" required autocomplete="current-password" />--}}
{{--                    <x-jet-input-error for="password"></x-jet-input-error>--}}
{{--                </div>--}}

{{--                <div class="mb-3">--}}
{{--                    <div class="custom-control custom-checkbox">--}}
{{--                        <x-jet-checkbox id="remember_me" name="remember" />--}}
{{--                        <label class="custom-control-label" for="remember_me">--}}
{{--                            {{ __('Remember Me') }}--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="mb-0">--}}
{{--                    <div class="d-flex justify-content-end align-items-baseline">--}}
{{--                        @if (Route::has('password.request'))--}}
{{--                            <a class="text-muted me-3" href="{{ route('password.request') }}">--}}
{{--                                {{ __('Forgot your password?') }}--}}
{{--                            </a>--}}
{{--                        @endif--}}

{{--                        <x-jet-button>--}}
{{--                            {{ __('Log in') }}--}}
{{--                        </x-jet-button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </x-jet-authentication-card>--}}
{{--</x-guest-layout>--}}

@extends('layouts.admin.login')
@section('title','Iniciar sesión panel')
@section('content')
    <h1 class="">Iniciar Sesión a <span class="brand-name">MECÁNICA FLORES</span></h1>
    <p class="signup-link">¿Eres nuevo? <a href="{{route('register')}}">Crear una cuenta</a></p>

    <form class="text-left" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form">
            <div id="username-field" class="field-wrapper input">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                             name="email" :value="old('email')" placeholder="Correo eléctronico" required />
                <x-jet-input-error for="email"></x-jet-input-error>
            </div>
            <div id="password-field" class="field-wrapper input mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                       placeholder="Contraseña" required autocomplete="current-password" >
                <x-jet-input-error for="password"></x-jet-input-error>
            </div>
            <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper toggle-pass">
                    <p class="d-inline-block">Mostrar Contraseña</p>
                    <label class="switch s-primary">
                        <input type="checkbox" id="toggle-password" class="d-none">
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="field-wrapper">
                    <button type="submit"  class="btn btn-dark" value="">Iniciar sesión</button>
                </div>
            </div>
            <div class="field-wrapper text-center keep-logged-in">
                <div class="n-chk new-checkbox checkbox-outline-primary">
                    <label class="new-control new-checkbox checkbox-outline-primary">
                        <input type="checkbox" name="remember" class="new-control-input">
                        <span class="new-control-indicator"></span>Mantenerme conectado
                    </label>
                </div>
            </div>
            <div class="custom-control custom-checkbox" id="remember_me">
                <div class="field-wrapper">
                    <a href="{{route('password.request')}}" class="forgot-pass-link">¿Olvidó sus cotraseña ?</a>
                </div>
            </div>
        </div>
    </form>
@endsection
