@extends('layouts.app')

@section('content')
    @if(Auth::user()->rol == 'profesor')
        @include('layouts.nav-profesor')
        <h1>Perfil del Profesor</h1>
        <p>Aquí va el contenido específico para profesores...</p>
    @elseif(Auth::user()->role == 'alumno')
        @include('layouts.nav-Alumno')
        <h1>Perfil del Alumno</h1>
        <p>Aquí va el contenido específico para alumnos...</p>
    @endif
@endsection