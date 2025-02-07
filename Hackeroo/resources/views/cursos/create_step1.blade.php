@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Botón para volver -->
    <div class="row mb-3 volver">
        <div class="col-12 text-left">
            <a href="{{ route('perfil') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>


    <form action="{{ route('cursos.store.step1') }}" method="POST" class="d-flex justify-content-center">
        @csrf

        <fieldset class="reset">
            <legend class="reset text-nowrap">Nuevo curso</legend>
            <div class="mb-5 mt-3 text-md-start">
                <x-input-label for="nombre" :value="__('Nombre del curso')" class="basico" />
                <x-text-input id="nombre"
                    class="form-control block"
                    type="text" name="nombre" :value="old('nombre')" required />
            </div>
           
        <div class="mb-5 mt-3 text-md-start">
                <x-input-label for="descripcion" :value="__('Descripción')" />
                <x-text-area class="form-control" id="descripcion" name="descripcion"></x-text-area>
        </div>
            <div class="col-12 mt-3 text-center mt-4">
            <x-primary-button type="submit" class="btn btn-primary ">Continuar</x-primary-button>
            </div>
        </fieldset>
    </form>
</div>
@endsection