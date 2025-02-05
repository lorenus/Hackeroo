@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3 volver">
        <div class="col-12 text-left">
            <a href="{{ route('cursos') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <h2 class='text-center'>Editar {{ $curso->nombre }}</h2>
    <div class='row'>
    <div class='col-12 col-md-6'>
        <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5 mt-3 text-md-start">
                <x-input-label for="nombre" :value="__('Nombre del curso:')" />
                <x-text-input id="nombre" class="form-control block" type="text" name="nombre" :
                    value="{{ old('nombre', $curso->nombre) }}" required />
            </div>

            <div class="mb-5 mt-3 text-md-start">
                <x-input-label for="descripcion" :value="__('Descripción:')" />
                <x-text-area class="form-control" id="descripcion" name="descripcion">
                    {{ old('descripcion', $curso->descripcion) }}</x-text-area>
            </div>
    </div>

    <div class='col-12 col-md-6'>
        <div class="mb-5 mt-3 text-md-start">
            <h6>Selecciona los alumnos que quieras añadir:</h6>



            @csrf
            <div class="tabla-scroll-container">
                <!-- Contenedor para el scroll -->
                <table>
                    <!-- Eliminamos la clase .tabla-scroll -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>DNI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnos as $alumno)
                        <tr>
                            <td>
                                <input type="checkbox" name="alumnos[]" value="{{ $alumno->DNI }}">
                            </td>
                            <td>{{ $alumno->nombre }} {{ $alumno->apellidos }}</td>
                            <td>{{ $alumno->DNI }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        <div class="col-12 mt-3 text-center mt-4">
            <x-primary-button type="submit">Actualizar</x-primary-button>
        </div>
        </form>
    
    </div>
</div>
</div>
@endsection