
@extends('layouts.admin.appenetero')


@section('content')

    <x-app-layout>

        <div class="mytabs">

            <input type="radio" id="tabprofile" name="mytabs" checked="checked">
            <label class="label" for="tabprofile"><i class="fa fa-edit">&nbsp;</i><i class="fa fa-user">&nbsp;</i>Actualizar mis datos</label>
            <div class="tab x_panel ">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    @livewire('profile.update-profile-information-form')
                @endif
            </div>

            <input type="radio" id="tabpass" name="mytabs">
            <label class="label" for="tabpass"><i class="fa fa-edit">&nbsp;</i><i class="fa fa-key">&nbsp;</i>Actualizar contraseña</label>
            <div class="tab x_panel">
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    @livewire('profile.update-password-form')
                @endif
            </div>

        </div>
    </x-app-layout>

@stop

@push('styles')
    <style>
        .mytabs {
            display: flex;
            flex-wrap: wrap;
            max-width: 100%;
            margin: 50px auto;
            padding: 25px;
        }
        .mytabs input[type="radio"] {
            display: none;
        }
        .mytabs .label {
            padding: 10px 17px;
            background: #b7b7b7;
            font-weight: bold;
            flex: inline-block;
            margin-bottom: 0rem;
            margin-left:0px;
            border-top: 1px solid;
            border-left: 1px solid;
            border-right: 1px solid;
        }

        .mytabs .tab {
            width: 100%;
            padding: 15px 20px;
            background: #343a40;
            order: 1;
            display: none;
            border: :
        }
        .mytabs .tab h2 {
            font-size: 3em;
        }

        .mytabs input[type='radio']:checked + .label + .tab {
            display: block;
        }

        .mytabs input[type="radio"]:checked + .label {
            background: #343a40;
        }
    </style>
@endpush
