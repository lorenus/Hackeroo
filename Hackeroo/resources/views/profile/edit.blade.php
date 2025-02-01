@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Perfil</h1>

    <!-- Mensaje de éxito al actualizar -->
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo para el nombre -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', Auth::user()->nombre) }}" required>
        </div>

        <!-- Campo para los apellidos -->
        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos', Auth::user()->apellidos) }}" required>
        </div>

        <!-- Campo para el correo electrónico -->
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
        </div>

        <!-- Botón para actualizar -->
        <button type="submit" class="btn btn-primary mt-3">Actualizar Perfil</button>
        <a href="{{ route('profesor.index') }}" class="btn btn-secondary mt-3">Volver</a>
    </form>
    
</div>
@endsection
