@extends('layouts.app')

@section('nav')
    @if(Auth::user()->rol == 'profesor')
        @include('layouts.nav-profesor')
    @elseif(Auth::user()->rol == 'alumno')
        @include('layouts.nav-alumno')
    @endif
@endsection

@section('content')
<style>
    :root {
        --user-color: {{ Auth::user()->color }};
    }
</style>

<div class="container container-perfil d-flex flex-column justify-content-center" style="@media (min-width: 768px) { max-width: 60vw !important; }">
    @if(Auth::user()->rol == 'profesor')
        <!-- Perfil del profesor -->
        <div class="perfil row-12 mb-3 d-flex justify-content-center align-items-center md-ps-5 md-pe-5 cuadrado" style="background-color: var(--user-color);">
            <div class="d-flex flex-row align-items-center mb-3 mb-md-0">
                <img src="/img/avatares/{{ Auth::user()->avatar }}" alt="Imagen 1" class="img-perfil-cabecera me-3 img-fluid">
                <h2>Hola, <span id="nombreUsuario">{{ Auth::user()->nombre }}</span></h2>
            </div>
        </div>

        <!-- Enlaces del profesor -->
        <div class="row d-flex justify-content-between mb-3 text-center">
            <div class="col-12 col-md-6 align-items-center">
                <div class="div-enlace mb-3 cuadrado" style="border-color: var(--user-color);">
                    <a href="{{ route('cursos') }}">
                        <img src="/img/iconos/cursos.png" alt="Enlace 1" class="img-fluid img-perfil">
                        <h4>Mis cursos</h4>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="div-enlace cuadrado" style="border-color: var(--user-color);">
                    <a href="{{ route('alumnos') }}">
                        <img src="/img/iconos/alumnos.png" alt="Enlace 2" class="img-fluid img-perfil">
                        <h4>Alumnos</h4>
                    </a>
                </div>
            </div>
        </div>

        <!-- Enlaces adicionales del profesor -->
        <div class="row d-flex justify-content-between mb-3 text-center d-none d-md-flex">
            <div class="col-12 col-md-6">
                <div class="div-enlace cuadrado" style="border-color: var(--user-color);">
                    <a href="{{ route('editar-perfil') }}">
                        <img src="/img/iconos/editar_perfil.png" alt="Enlace 3" class="img-fluid img-perfil">
                        <h4>Editar perfil</h4>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="cerrar-sesion">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #455A64;">
                            <img src="/img/iconos/sesion.png" alt="Enlace 4" class="img-fluid img-perfil">
                            <h4>Cerrar sesión</h4>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    @elseif(Auth::user()->rol == 'alumno')
        <!-- Perfil del alumno -->
        <div class="perfil row-12 mb-3 d-flex flex-column flex-md-row justify-content-center align-items-center ps-2 pe-2 md-ps-5 md-pe-5 cuadrado" style="background-color: var(--user-color);">
            <div class="d-flex flex-row align-items-center justify-content-center mb-1 mb-md-0 md-pe-5 me-md-5">
                <img src="/img/avatares/{{ Auth::user()->avatar }}" alt="Avatar" class="img-perfil-cabecera me-3 img-fluid ms-2">
                <h2>Hola, <span id="nombreUsuario">{{ Auth::user()->nombre }}</span></h2>
            </div>

            <div class="puntuacion d-flex flex-column align-items-center ps-3 pe-3">
                <img src="/img/iconos/corona.png" alt="Imagen 2" class="img-corona d-none d-md-block img-fluid">
                <div class="flex-md-column">
                    <h5 class="text-center">Nivel {{ intval(Auth::user()->puntos / 10) }}</h5>
                    <h5>{{ Auth::user()->puntos }} puntos</h5>
                </div>
            </div>
        </div>

        <!-- Enlaces del alumno -->
        <div class="row d-flex justify-content-between mb-3 text-center">
            <div class="col-12 col-md-6">
                <div class="div-enlace mb-3 cuadrado" style="border-color: var(--user-color);">
                    <a href="{{ route('cursos-alumno') }}">
                        <img src="/img/iconos/cursos.png" alt="Enlace 1" class="img-fluid img-perfil">
                        <h4>Mis cursos</h4>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="div-enlace cuadrado" style="border-color: var(--user-color);">
                    <a href="{{ route('ranking') }}">
                        <img src="/img/iconos/trofeo.png" alt="Enlace 2" class="img-fluid img-perfil">
                        <h4>Ranking</h4>
                    </a>
                </div>
            </div>
        </div>

        <!-- Enlaces adicionales del alumno -->
        <div class="row d-flex justify-content-between mb-3 text-center d-none d-md-flex">
            <div class="col-12 col-md-6">
                <div class="div-enlace cuadrado" style="border-color: var(--user-color);">
                    <a href="{{ route('editar-perfil') }}">
                        <img src="/img/iconos/editar_perfil.png" alt="Enlace 3" class="img-fluid img-perfil">
                        <h4>Editar perfil</h4>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="cerrar-sesion">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #455A64;">
                            <img src="/img/iconos/sesion.png" alt="Enlace 4" class="img-fluid img-perfil">
                            <h4>Cerrar sesión</h4>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection