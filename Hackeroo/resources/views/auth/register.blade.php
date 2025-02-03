@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="text-center content-align-center">
        <h2>Crea una cuenta</h2>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-12 mb-3 text-center">
                <!-- <select id="rol" name="rol" class="form-select text-center block">
                    <option value="alumno" selected>{{ __('Alumno') }}</option>
                    <option value="profesor">{{ __('Profesor') }}</option>
                </select> -->

                <div class="custom-select text-center" id="rol" name="rol">
                    <div class="option" value="alumno">Alumno</div>
                    <div class="option" value="profesor" >Profesor</div>
                    <div class="selector"></div>
                </div>
            </div>

            <div class="col-12 col-md-6 mt-3 mb-3 text-md-start text-center">
                <x-input-label for="DNI" :value="__('DNI')" />
                <x-text-input id="DNI"
                    class="form-control block"
                    type="text" name="DNI" :value="old('DNI')" required autofocus />
                <x-input-error :messages="$errors->get('DNI')" class="mt-2" />
            </div>

            <div class="col-12 col-md-6  mt-3 mb-3 text-md-start text-center">
                <x-input-label for="nombre" :value="__('Nombre')" />
                <x-text-input id="nombre"
                    class="form-control block"
                    type="text" name="nombre" :value="old('nombre')" required />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>

            <div class="col-12 col-md-6 mt-3 mb-3 text-md-start text-center">
                <x-input-label for="apellidos" :value="__('Apellidos')" />
                <x-text-input id="apellidos"
                    class="form-control block"
                    type="text" name="apellidos" :value="old('apellidos')" required />
                <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
            </div>

            <div class="col-12 col-md-6 mb-3  mt-3 text-md-start text-center">
                <x-input-label for="email" :value="__('Correo Electrónico')" />
                <x-text-input id="email"
                    class="form-control block"
                    type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="col-12 col-md-6 mb-3  mt-3 text-md-start text-center">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password"
                    class="form-control block"
                    type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="col-12 col-md-6 mb-3 mt-3 text-md-start text-center">
                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                <x-text-input id="password_confirmation"
                    class="form-control block"
                    type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="col-12 mt-3 text-center mt-4">
                <x-primary-button class='btn border-0'>
                    {{ __('Registrarse') }}
                </x-primary-button>
            </div>

        </div>
    </div>
</form>

@endsection