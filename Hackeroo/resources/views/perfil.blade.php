@extends('layouts.app')

@section('nav')
    @if(Auth::user()->rol == 'profesor')
        @include('layouts.nav-profesor')
    @elseif(Auth::user()->rol == 'alumno')
        @include('layouts.nav-alumno')
    @endif
@endsection

@section('content')
    <div class="container container-perfil d-flex flex-column justify-content-center">
        @if(Auth::user()->rol == 'profesor')
            <div class="perfil row-12 mb-3 d-flex justify-content-center align-items-center ps-5 pe-5 cuadrado" style="background-color: {{ Auth::user()->color }};">
                <div class="d-flex flex-row align-items-center mb-3 mb-md-0">
                    <img src="/img/avatares/{{ Auth::user()->avatar }}" alt="Imagen 1" class="img-perfil-cabecera me-3 img-fluid">
                    <h2>Hola, <span id="nombreUsuario">{{ Auth::user()->nombre }}</span></h2>
                </div>
            </div>

            <div class="row d-flex justify-content-between mb-3 text-center">
                <div class="col-12 col-md-6 align-items-center">
                    <div class="div-enlace mb-3 cuadrado" style="border-color: {{ Auth::user()->color }};">
                        <a href="{{ route('cursos') }}">
                            <img src="/img/iconos/cursos.png" alt="Enlace 1" class="img-fluid img-perfil">
                            <h4>Mis cursos</h4>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="div-enlace cuadrado" style="border-color: {{ Auth::user()->color }};">
                        <a href="{{ route('alumnos') }}">
                            <img src="/img/iconos/alumnos.png" alt="Enlace 2" class="img-fluid img-perfil">
                            <h4>Alumnos</h4>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-between mb-3 text-center d-none d-md-flex">
                <div class="col-12 col-md-6">
                    <div class="div-enlace cuadrado" style="border-color: {{ Auth::user()->color }};">
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
            <div class="perfil row-12 mb-3 d-flex flex-column flex-md-row justify-content-between align-items-center ps-5 pe-5 cuadrado" style="background-color: {{ Auth::user()->color }};">
                <div class="d-flex flex-row align-items-center mb-3 mb-md-0">
                    <img src="/img/avatares/1.png" alt="Imagen 1" class="img-perfil-cabecera me-3 img-fluid">
                    <h2>Hola, <span id="nombreUsuario">{{ Auth::user()->nombre }}</span></h2>
                </div>

                <div class="puntuacion d-flex flex-column align-items-center ps-3 pe-3">
                    <img src="/img/iconos/corona.png" alt="Imagen 2" class="img-corona d-none d-md-block img-fluid">
                    <div class="d-flex flex-row flex-md-column">
                        <h5 class="text-center">Nivel 3</h5>
                        <h5>{{ Auth::user()->puntos }} puntos</h5>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-between mb-3 text-center">
                <div class="col-12 col-md-6">
                    <div class="div-enlace mb-3 cuadrado" style="border-color: {{ Auth::user()->color }};">
                        <a href="{{route('cursos-alumno')}}">
                            <img src="/img/iconos/cursos.png" alt="Enlace 1" class="img-fluid img-perfil">
                            <h4>Mis cursos</h4>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="div-enlace cuadrado" style="border-color: {{ Auth::user()->color }};">
                        <a href="{{ route('ranking') }}">
                            <img src="/img/iconos/trofeo.png" alt="Enlace 2" class="img-fluid img-perfil">
                            <h4>Ranking</h4>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-between mb-3 text-center d-none d-md-flex">
                <div class="col-12 col-md-6">
                    <div class="div-enlace cuadrado" style="border-color: {{ Auth::user()->color }};">
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