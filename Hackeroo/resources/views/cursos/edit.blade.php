@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Curso: {{ $curso->nombre }}</h1>

    <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre del Curso</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $curso->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $curso->descripcion) }}</textarea>
        </div>

        <!-- Campo de selección de alumnos -->
        <div class="form-group">
            <label for="alumnos">Selecciona Alumnos</label>
            <select class="form-control" id="alumnos" name="alumnos[]" multiple required>
                @foreach($alumnos as $alumno)
                    <option value="{{ $alumno->DNI }}" 
                        @if(in_array($alumno->DNI, $curso->alumnos->pluck('DNI')->toArray())) selected @endif>
                        {{ $alumno->nombre }} {{ $alumno->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Actualizar Curso</button>
    </form>

    <a href="{{ route('cursos') }}" class="btn btn-secondary mt-3">Cancelar</a>
</div>
@endsection
