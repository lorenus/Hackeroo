<!-- resources/views/profile/alumno.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>¡Hola, Alumno {{ Auth::user()->nombre }}!</h1>
    <p>Bienvenido a tu página de perfil.</p>
    
    <div class="alert alert-info">
        Esta es tu página de alumno. Desde aquí podrás ver tus cursos y más.
    </div>

    <h2><a href="{{ route('cursos.index.alumno') }}"  class="btn btn-secondary mt-3">Ver tus cursos</a></h2>

    <!-- Enlace para editar la cuenta -->
    <a href="{{ route('profile.edit') }}" class="btn btn-secondary mt-3">Editar cuenta</a>

    <!-- Si deseas añadir más funcionalidades en el futuro, puedes agregar más botones o enlaces aquí -->
</div>
<form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-danger">
        Cerrar sesión
    </button>
</form>
@endsection
