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
<h1>img-Perfil del Profesor</h1>
<p>Aquí va el contenido específico para profesores...</p>
@elseif(Auth::user()->rol == 'alumno')
<div class="container contenedor-perfil d-flex flex-column">
    <!-- Primera fila -->
        <div class="perfil row-12 mb-4 d-flex justify-content-between align-items-center ps-5 pe-5">
            <img src="/img/avatares/1.png" alt="Imagen 1" class="img-fluid img-perfil-cabecera">
            <h2>Hola, <span id="nombreUsuario">Usuario</span></h2>
            <div class="puntuacion"><img src="/img/iconos/corona.png" alt="Imagen 2" class="img-fluid img-perfil"></div>
        </div>


    <!-- Segunda fila (enlaces) -->
    <div class="row d-flex justify-content-between mb-4 text-center">
        <div class="col-12 col-md-6">
            <div class="div-enlace">
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
    <div class="row d-flex justify-content-between mb-4 text-center d-none d-md-flex">
        <div class="col-12 col-md-6 ">
            <div class="div-enlace">
                <a href="#">
                    <img src="/img/iconos/editar_perfil.png" alt="Enlace 3" class="img-fluid img-perfil">
                    <h4>Editar perfil</h4>
                </a>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="cerrar-sesion">
                <a href="#">
                    <img src="/img/iconos/sesion.png" alt="Enlace 4" class="img-fluid img-perfil">
                    <h4>Cerrar sesión</h4>
                </a>
            </div>
        </div>
    </div>

</div>
@endif
@endsection