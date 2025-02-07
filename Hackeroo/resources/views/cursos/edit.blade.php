@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Curso: {{ $curso->nombre }}</h1>

    <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre del Curso</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ old('nombre', $curso->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="4"
                required>{{ old('descripcion', $curso->descripcion) }}</textarea>
        </div>

        <!-- Campo de selección de alumnos -->
        <!-- Campo de búsqueda -->
        <div class="input-group mb-4">
            <input type="text" id="search" class="form-control" placeholder="Buscar alumno por nombre o apellidos">
            <!-- El botón ya no es necesario, pero lo dejamos por si acaso -->
            <button type="button" class="btn btn-primary" onclick="filterAlumnos()">Filtrar</button>
        </div>

        <!-- Tabla de alumnos -->
        <div class="tabla-scroll-container">
            <table id="alumnos-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>DNI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumnos as $alumno)
                    <tr class="alumno-row">
                        <td>
                            <input type="checkbox" name="alumnos[]" value="{{ $alumno->DNI }}"
                                {{ $cursos_alumnos->contains($alumno->DNI) ? 'checked' : '' }}>
                        </td>
                        <td>{{ $alumno->nombre }} {{ $alumno->apellidos }}</td>
                        <td>{{ $alumno->DNI }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-success mt-3">Actualizar Curso</button>
    </form>

    <a href="{{ route('cursos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
</div>
@endsection