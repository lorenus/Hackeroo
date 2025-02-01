<!-- resources/views/profile/profesor.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>¡Hola, Profesor {{ Auth::user()->nombre }}!</h1>
    <p>Bienvenido a tu página de perfil.</p>
    
    <div class="alert alert-info">
        Esta es tu página de profesor. Desde aquí puedes gestionar tus cursos y más.
    </div>
    
    <h2><a href="{{ route('alumnos.ver') }}">Ver alumnos de tus cursos</a></h2>

    <a href="{{ route('cursos.index') }}" class="btn btn-primary">Ver mis cursos</a>

    <!-- Enlace para editar la cuenta -->
    <a href="{{ route('profile.edit') }}" class="btn btn-secondary mt-3">Editar cuenta</a>
</div>
<form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit">
        Cerrar sesión
    </button>
</form>
@endsection
