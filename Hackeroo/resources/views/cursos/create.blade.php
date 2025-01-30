@extends('layouts.app')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
            <label for="alumnos" class="form-label">Selecciona Alumnos</label>
            <select class="form-control" id="alumnos" name="alumnos[]" multiple required>
                @foreach($alumnos as $alumno)
                <option value="{{ $alumno->DNI }}">{{ $alumno->nombre }} {{ $alumno->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Añadir Curso</button>
    </form>
</div>
@endsection