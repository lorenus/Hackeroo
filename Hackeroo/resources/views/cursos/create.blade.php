@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Curso</h1>

    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario para añadir un curso -->
    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Curso</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>

        <div class="mb-3">
            <label for="profesor_dni" class="form-label">Selecciona Profesor</label>
            <select class="form-control" id="profesor_dni" name="profesor_dni" required>
                @foreach($profesores as $profesor)
                    <option value="{{ $profesor->DNI }}">{{ $profesor->nombre }} {{ $profesor->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Añadir Curso</button>
    </form>
</div>
@endsection
