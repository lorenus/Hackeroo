@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Editar Perfil</h1>

    <!-- Mensaje de éxito al actualizar -->
    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="d-flex justify-content-center align-items-center">
        <form action="{{ route('profile.update') }}" method="POST" class="text-center col-md-4">
            @csrf
            @method('PUT')

            <!-- Campo para el nombre -->
            <div class="form-group mt-3">
                <label for="nombre">Nombre</label>
                <x-text-input type="text" class="form-control text-center" id="nombre" name="nombre" value="{{ old('nombre', Auth::user()->nombre) }}" required />
            </div>

            <!-- Campo para los apellidos -->
            <div class="form-group mt-3">
                <label for="apellidos">Apellidos</label>
                <x-text-input type="text" class="form-control text-center" id="apellidos" name="apellidos" value="{{ old('apellidos', Auth::user()->apellidos) }}" required />
            </div>

            <!-- Campo para el correo electrónico -->
            <div class="form-group mt-3">
                <label for="email">Correo Electrónico</label>
                <x-text-input type="email" class="form-control text-center" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required />
            </div>

            <!-- Botón para actualizar -->
            <x-primary-button type="submit" class="btn btn-primary mt-3 text-center">Actualizar Perfil</x-primary-button>
            <a href="{{ route('profesor.index') }}" class="btn btn-secondary mt-3">Volver</a>
        </form>
    </div>
</div>
@endsection