@extends('layouts.app')

@section('nav')
    @if(Auth::user()->rol == 'profesor')
        @include('layouts.nav-profesor')  
    @elseif(Auth::user()->rol == 'alumno')
        @include('layouts.nav-alumno')   
    @endif
@endsection

@section('content')
        @if(Auth::user()->rol == 'profesor')
            <h1>Perfil del Profesor</h1>
            <p>Aquí va el contenido específico para profesores...</p>
        @elseif(Auth::user()->rol == 'alumno')
            <h1>Perfil del Alumno</h1>
            <p>Aquí va el contenido específico para alumnos...</p>
        @endif
@endsection
