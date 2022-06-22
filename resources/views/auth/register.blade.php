<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-3" />

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <x-jet-label value="{{ __('Name') }}" />

                    <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" required autofocus autocomplete="name" />
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Confirm Password') }}" />
                    <x-jet-input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
                <div class="mb-3">
                    <x-jet-label value="{{ __('Ruc') }}" />
                    <x-jet-input class="form-control" type="text" name="ruc" required />
                </div>
                <div class="mb-3">
                    <x-jet-label value="{{ __('Dni') }}" />
                    <x-jet-input class="form-control" type="text" name="dni" required />
                </div>
                <div class="mb-3">
                    <x-jet-label value="{{ __('Celular') }}" />
                    <x-jet-input class="form-control" type="text" name="phone" required />
                </div>
                <div class="mb-3">
                    <x-jet-label value="{{ __('Dirección') }}" />
                    <x-jet-input class="form-control" type="text" name="address" required />
                </div>
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox">
                            <x-jet-checkbox id="terms" name="terms" />
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-jet-button>
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>

{{--@extends('layouts.admin.login')--}}
{{--@section('title','Registrarse panel')--}}

{{--@section('content')--}}

{{--    <h1 class="">Crear una cuenta</h1>--}}
{{--    <p class="signup-link">¿Ya tiene una cuenta? <a href="{{route('login')}}">Iniciar sesión</a></p>--}}
{{--    <form class="text-left" method="POST" action="{{ route('register') }}">--}}
{{--        @csrf--}}
{{--        <div class="form">--}}
{{--            <div id="username-field" class="field-wrapper input">--}}
{{--                <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"--}}
{{--                             :value="old('name')" required autofocus autocomplete="name" placeholder="Nombres y Apellidos"/>--}}
{{--                <x-jet-input-error for="name"></x-jet-input-error>--}}
{{--            </div>--}}
{{--            <div id="email-field" class="field-wrapper input">--}}
{{--                <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"--}}
{{--                             :value="old('email')" required placeholder="Correo eléctronico"/>--}}
{{--                <x-jet-input-error for="email"></x-jet-input-error>--}}
{{--            </div>--}}
{{--            <div id="password-field" class="field-wrapper input mb-2">--}}
{{--                <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"--}}
{{--                       placeholder="Contraseña" required autocomplete="current-password" >--}}
{{--                <x-jet-input-error for="password"></x-jet-input-error>--}}
{{--            </div>--}}
{{--            <div id="password-field" class="field-wrapper input mb-2">--}}
{{--                <input id="password" name="password_confirmation" type="password" class="form-control"--}}
{{--                       placeholder="Confirmar contraseña" required autocomplete="new-password" >--}}
{{--            </div>--}}
{{--            <div id="ruc-field" class="field-wrapper input">--}}
{{--                <x-jet-input class="{{ $errors->has('ruc') ? 'is-invalid' : '' }}" type="text" name="ruc"--}}
{{--                             :value="old('ruc')" required autofocus autocomplete="ruc" placeholder="Ruc"/>--}}
{{--                <x-jet-input-error for="ruc"></x-jet-input-error>--}}
{{--            </div>--}}
{{--            <div id="dni-field" class="field-wrapper input">--}}
{{--                <x-jet-input class="{{ $errors->has('dni') ? 'is-invalid' : '' }}" type="text" name="dni"--}}
{{--                             :value="old('dni')" required autofocus autocomplete="ruc" placeholder="Dni"/>--}}
{{--                <x-jet-input-error for="dni"></x-jet-input-error>--}}
{{--            </div>--}}
{{--            <div id="phone-field" class="field-wrapper input">--}}
{{--                <x-jet-input class="{{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone"--}}
{{--                             :value="old('phone')" required autofocus autocomplete="ruc" placeholder="Celular"/>--}}
{{--                <x-jet-input-error for="phone"></x-jet-input-error>--}}
{{--            </div>--}}
{{--            <div id="address-field" class="field-wrapper input">--}}
{{--                <x-jet-input class="{{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address"--}}
{{--                             :value="old('address')" required autofocus autocomplete="ruc" placeholder="Dirección"/>--}}
{{--                <x-jet-input-error for="address"></x-jet-input-error>--}}
{{--            </div>--}}
{{--            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())--}}
{{--            <div class="field-wrapper terms_condition">--}}
{{--                <div class="n-chk new-checkbox checkbox-outline-primary">--}}
{{--                    <label class="new-control new-checkbox checkbox-outline-primary">--}}
{{--                        <input type="checkbox"  id="terms" name="terms" class="new-control-input">--}}
{{--                        <span class="new-control-indicator"></span>--}}
{{--                        <span>Acepto los <a href="{{route('terms.show')}}">  términos </a>and<a href="{{route('policy.show')}}"> condiciones </a></span>--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endif--}}
{{--            <div class="d-sm-flex justify-content-between">--}}
{{--                <div class="field-wrapper toggle-pass">--}}
{{--                    <p class="d-inline-block">Mostrar contraseña</p>--}}
{{--                    <label class="switch s-primary">--}}
{{--                        <input type="checkbox" id="toggle-password" class="d-none">--}}
{{--                        <span class="slider round"></span>--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="field-wrapper">--}}
{{--                    <button type="submit" class="btn btn-dark" value="">Registrarme</button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </form>--}}

{{--@endsection--}}
