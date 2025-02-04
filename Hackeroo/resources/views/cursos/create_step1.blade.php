@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Curso - Paso 1</h1>

    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('cursos.store.step1') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Curso</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Continuar</button>
        <a href="{{ route('cursos') }}" class="btn btn-secondary">Mis Cursos</a>
    </form>
</div>
@endsection
