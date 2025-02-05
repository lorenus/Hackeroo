@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3 volver">
        <div class="col-12 text-left">
            <a href="{{ route('perfil') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <h2 class='text-center'>Editar Perfil</h2>

    <!-- Mensaje de éxito al actualizar -->
    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif
<form action="{{ route('profile.update') }}" method="POST">
    <div class='row'>
        <div class='col-12 col-md-6'>
            
                @csrf
                @method('PUT')

                <div class='editar-color'>
                    <h5>Color del perfil</h5>
                    <div class='row row-cols-6 g-2'>

                    </div>
                </div>
                <!-- <div class="form-group mt-3 text-start">
                    <label for="nombre">Nombre</label>
                    <x-text-input type="text" class="form-control text-start" id="nombre" name="nombre"
                        value="{{ old('nombre', Auth::user()->nombre) }}" required />
                </div>

                
                <div class="form-group mt-3 text-start">
                    <label for="apellidos">Apellidos</label>
                    <x-text-input type="text" class="form-control text-start" id="apellidos" name="apellidos"
                        value="{{ old('apellidos', Auth::user()->apellidos) }}" required />
                </div>

                
                <div class="form-group mt-3 text-start">
                    <label for="email">Correo Electrónico</label>
                    <x-text-input type="email" class="form-control text-start" id="email" name="email"
                        value="{{ old('email', Auth::user()->email) }}" required />
                </div> -->





        </div>
        <div class='col-12 col-md-6'>

            <div class='editar-avatar'>
                <h5>Imagen de perfil</h5>
                <div class='row row-cols-3 g-2'>
                    <div class="col">
                        <x-avatar src="/img/avatares/1.png"></x-avatar>
                    </div>
                    <div class="col">
                        <x-avatar src="/img/avatares/2.png"></x-avatar>
                    </div>
                    <div class="col">
                        <x-avatar src="/img/avatares/3.png"></x-avatar>
                    </div>
                    <div class="col">
                        <x-avatar src="/img/avatares/4.png"></x-avatar>
                    </div>
                    <div class="col">
                        <x-avatar src="/img/avatares/5.png"></x-avatar>
                    </div>
                    <div class="col">
                        <x-avatar src="/img/avatares/6.png"></x-avatar>
                    </div>
                    <div class="col">
                        <x-avatar src="/img/avatares/7.png"></x-avatar>
                    </div>
                    <div class="col">
                        <x-avatar src="/img/iconos/candado.png"></x-avatar>
                    </div>
                    <div class="col">
                        <x-avatar src="/img/iconos/candado.png"></x-avatar>
                    </div>
                </div>
            </div>





        </div>

    </div>






    <!-- Botón para actualizar -->
    <div class="d-flex justify-content-center align-items-center">
        <x-primary-button type="submit" class="btn btn-primary mt-3 text-center">Actualizar Perfil
        </x-primary-button>
    </div>
    </form>
</div>
@endsection