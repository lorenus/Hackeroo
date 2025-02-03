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
<div class="container contenedor-perfil">
    <div class="row align-items-center mb-4">
       
        <div class="perfil row-12 d-flex align-items-center">
            <div class="img-container m-3">
                <img src="/img/avatares/1.png" alt="Imagen 1" class="img-fluid img-perfil">
            </div>
            <div>
                <h2>Hola, <span id="nombreUsuario">Usuario</span></h2>
            </div>
            <div class="col-md-6 text-end">
                <div class="img-container m-3">
                    <img src="/img/iconos/corona.png" alt="Imagen 2" class="img-fluid img-perfil">
                </div>
            </div>
        </div>

        <!-- Segunda fila (enlaces) -->
        <div class="row mb-4">
            <!-- Enlace 1 -->
            <div class="div-enlance col-md-6 link-box">
                <a href="#">
                    <img src="/img/iconos/cursos.png" alt="Enlace 1" class="img-fluid img-perfil">
                    <p>Mis cursos</p>
                </a>
            </div>
            <!-- Enlace 2 -->
            <div class="div-enlance col-md-6 link-box">
                <a href="#">
                    <img src="/img/iconos/trofeo.png" alt="Enlace 2" class="img-fluid img-perfil">
                    <p>Ranking</p>
                </a>
            </div>
        </div>

        <!-- Tercera fila (enlaces, oculta en móvil) -->
        <div class="row d-none d-md-block">
            <!-- Enlace 3 -->
            <div class="div-enlance col-md-6 link-box">
                <a href="#">
                    <img src="/img/iconos/editar_perfil.png" alt="Enlace 3" class="img-fluid img-perfil">
                    <p>Editar Perfil</p>
                </a>
            </div>
            <!-- Enlace 4 -->
            <div class="cerrar-sesion col-md-6 link-box">
                <a href="#">
                    <img src="/img/iconos/sesion.png" alt="Enlace 4" class="img-fluid img-perfil">
                    <p>Cerrar sesion</p>
                </a>
            </div>
        </div>

    </div>
</div>
    @endif
    @endsection