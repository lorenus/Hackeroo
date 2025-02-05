@extends('layouts.app')

@section('content')
<div class="container text-center h-25">
    <h1>Ranking</h1>
    <p>A continuación, verás a todos los alumnos ordenados por su número de puntos:</p>
    <div class="contenido container-fluid d-flex flex-column flex-md-row p-3">
        <!-- Imagen -->
        <div class="col-12 col-md-6 d-flex justify-content-center text-center order-0 order-md-0">
            <img src="/img/imagenes/ranking.png" alt="Imagen" class="img-fluid">
        </div>

        <!-- Contenedor de ranking y tabla -->
        <div class="col-12 col-md-6 order-1 order-md-1">
            <!-- Ranking Superior -->
            <div class="ranking-container mb-4">
                @php
                $colores = ['amarillo', 'verde', 'azul'];
                @endphp

                @foreach($usuarios as $index => $usuario)
                @if($index < 3)
                    <div class="ranking-item {{ $colores[$index] }} d-flex justify-content-between align-items-center h-23 mb-2 p-3">
                    <h3 class="d-flex w-100 justify-content-between">
                        <div class="d-flex">
                            <span>{{ $index + 1 }}</span> &nbsp; &nbsp;
                            <span>{{ $usuario->nombre }} {{ $usuario->apellidos }}</span>
                        </div>
                        <div class="d-flex justify-content-end"><b>{{ $usuario->puntos }} pts.</b></div>
                    </h3>
            </div>

            @endif
            @endforeach
        </div>

        <!-- Tabla (Solo muestra a partir del puesto 4) -->
        <div class="tabla-scroll-container">
            <table>
                <tbody>
                    @foreach($usuarios as $index => $usuario)
                    @if($index >= 3)
                    <tr></tr>
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $usuario->nombre }} {{ $usuario->apellidos }}</td>
                        <td>{{ $usuario->puntos }} puntos</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection