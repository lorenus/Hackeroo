@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Curso - Paso 2</h1>

    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('cursos.store.step2') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="alumnos" class="form-label">Selecciona Alumnos</label>
            <select class="form-control" id="alumnos" name="alumnos[]" multiple required>
                @foreach($alumnos as $alumno)
                <option value="{{ $alumno->DNI }}">{{ $alumno->nombre }} {{ $alumno->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Curso</button>
    </form>
</div>
@endsection
