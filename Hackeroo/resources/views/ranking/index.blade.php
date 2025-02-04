@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Ranking</h1>
    <p>A continuación, verás a todos los alumnos ordenados por su número de puntos:</p>
    <div class="contenido container-fluid d-flex flex-column flex-md-row p-3">
        <!-- Imagen -->
        <div class="col-12 col-md-6 d-flex justify-content-center text-center order-0 order-md-0">
            <img src="/img/imagenes/ranking.png" alt="Imagen" class="img-fluid">
        </div>

        <!-- Contenedor de ranking y tabla -->
        <div class="col-12 col-md-6 order-1 order-md-1">
            <!-- Ranking -->
            <div class="ranking-container">
                <!-- Ranking item 1 -->
                <div class="ranking-item amarillo d-flex justify-content-between h-25 mb-2 p-3">
                    <h3><span>1</span> <span>Nombre Apellido</span></h3>
                </div>
                <!-- Ranking item 2 -->
                <div class="ranking-item verde d-flex justify-content-between h-25 mb-2 p-3">
                    <h3><span>2</span> <span>Nombre Apellido</span></h3>
                </div>
                <!-- Ranking item 3 -->
                <div class="ranking-item azul d-flex justify-content-between h-25 mb-2 p-3">
                    <h3><span>3</span> <span>Nombre Apellido</span></h3>
                </div>
            </div>

            <!-- Tabla -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Puntos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $index => $usuario)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $usuario->nombre }} {{ $usuario->apellidos }}</td>
                        <td>{{ $usuario->puntos }} puntos</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection