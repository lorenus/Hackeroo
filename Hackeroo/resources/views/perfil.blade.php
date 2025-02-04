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
<div class="container contenedor-perfil d-flex flex-column justify-content-center">

    <div class="perfil row-12 mb-3 d-flex justify-content-center align-items-center ps-5 pe-5">
        <!-- Imagen y nombre de usuario -->
        <div class="d-flex flex-row align-items-center mb-3 mb-md-0">
            <img src="/img/avatares/1.png" alt="Imagen 1" class="img-perfil-cabecera me-3">
            <h2>Hola, <span id="nombreUsuario">Profesor</span></h2>
        </div>
    </div>

    <!-- Segunda fila (enlaces) -->
    <div class="row d-flex justify-content-between mb-3 text-center ">
        <div class="col-12 col-md-6 align-items-center">
            <div class="div-enlace mb-3">
                <a href="{{ route('cursos') }}">
                    <img src="/img/iconos/cursos.png" alt="Enlace 1" class="img-fluid img-perfil">
                    <h4>Mis cursos</h4>
                </a>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="div-enlace">
                <a href="{{ route('alumnos') }}">
                    <img src="/img/iconos/alumnos.png" alt="Enlace 2" class="img-fluid img-perfil">
                    <h4>Alumnos</h4>
                </a>
            </div>
        </div>
    </div>

    <!-- Tercera fila (enlaces, oculta en móvil) -->
    <div class="row d-flex justify-content-between mb-3 text-center d-none d-md-flex">
        <div class="col-12 col-md-6">
            <div class="div-enlace">
                <a href="#">
                    <img src="/img/iconos/editar_perfil.png" alt="Enlace 3" class="img-fluid img-perfil">
                    <h4>Editar perfil</h4>
                </a>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="cerrar-sesion">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="background: none; border: none;">
                        <img src="/img/iconos/sesion.png" alt="Enlace 4" class="img-fluid img-perfil">
                        <h4>Cerrar sesión</h4>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>









@elseif(Auth::user()->rol == 'alumno')
<div class="container contenedor-perfil d-flex flex-column justify-content-center">

    <div class="perfil row-12 mb-3 d-flex flex-column flex-md-row justify-content-between align-items-center ps-5 pe-5">
        <!-- Imagen y nombre de usuario -->
        <div class="d-flex flex-row align-items-center mb-3 mb-md-0">
            <img src="/img/avatares/1.png" alt="Imagen 1" class="img-perfil-cabecera me-3">
            <h2>Hola, <span id="nombreUsuario">Usuario</span></h2>
        </div>

        <!-- Puntuación (nivel y puntos) -->
        <div class="puntuacion d-flex flex-column align-items-center ps-3 pe-3">
            <!-- Imagen de la corona (solo en pantallas grandes y medianas) -->
            <img src="/img/iconos/corona.png" alt="Imagen 2" class="img-corona d-none d-md-block">
            <!-- Textos (nivel y puntos) -->
            <div class="d-flex flex-row flex-md-column">
                <h5 class="me-3">Nivel 3</h5>
                <h5>100 pts</h5>
            </div>
        </div>
    </div>

    <!-- Segunda fila (enlaces) -->
    <div class="row d-flex justify-content-between mb-3 text-center">
        <div class="col-12 col-md-6">
            <div class="div-enlace mb-3">
                <a href="#">
                    <img src="/img/iconos/cursos.png" alt="Enlace 1" class="img-fluid img-perfil">
                    <h4>Mis cursos</h4>
                </a>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="div-enlace">
                <a href="#">
                    <img src="/img/iconos/trofeo.png" alt="Enlace 2" class="img-fluid img-perfil">
                    <h4>Ranking</h4>
                </a>
            </div>
        </div>
    </div>

    <!-- Tercera fila (enlaces, oculta en móvil) -->
    <div class="row d-flex justify-content-between mb-3 text-center d-none d-md-flex">
        <div class="col-12 col-md-6">
            <div class="div-enlace">
                <a href="#">
                    <img src="/img/iconos/editar_perfil.png" alt="Enlace 3" class="img-fluid img-perfil">
                    <h4>Editar perfil</h4>
                </a>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="cerrar-sesion">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="background: none; border: none;">
                        <img src="/img/iconos/sesion.png" alt="Enlace 4" class="img-fluid img-perfil">
                        <h4>Cerrar sesión</h4>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection