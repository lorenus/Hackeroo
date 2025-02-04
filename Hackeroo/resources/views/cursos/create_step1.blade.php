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


    <form action="{{ route('cursos.store.step1') }}" method="POST">
        @csrf

        <fieldset>
            <legend class="text-center">Nuevo curso</legend>
                <x-input-label for="nombre" :value="__('Nombre del curso')" />
                <x-text-input id="nombre"
                    class="form-control block"
                    type="text" name="nombre" :value="old('nombre')" required />

            <!-- 
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Curso</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div> -->
                <x-input-label for="descripcion" :value="__('Descripción')" />
                <x-text-area class="form-control" id="descripcion" name="descripcion"></x-text-area>
                <!-- <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div> -->
            
            <x-primary-button type="submit" class="btn btn-primary">Continuar</x-primary-button>
        </fieldset>
    </form>
</div>
@endsection