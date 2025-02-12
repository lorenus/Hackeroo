@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Botón para volver -->
    <div class="row mb-3 volver">
        <div class="col-12 text-left">
            <a href="{{ route('alumnos') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <h2 class="text-center">{{ $alumno->nombre }} {{ $alumno->apellidos }}</h2>
        <form action="#" method="" class='d-flex justify-content-center align-items-center'>
            @csrf
            <fieldset>
                <legend class="text-nowrap">{{ $curso->nombre }}</legend>
                <div class="tabla-scroll-container">
                    @if(isset($noTareas) && $noTareas)
                        <!-- Mostrar mensaje si no hay tareas -->
                        <p class="text-center">No hay tareas de tipo test en este curso.</p>
                    @else
                        <!-- Mostrar tabla con las tareas -->
                        <table>
                            <thead>
                                <tr>
                                    <th>Ejercicio</th>
                                    <th>Nota</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resultadosTareas as $resultado)
                                    <tr>
                                        <td>{{ $resultado['tarea']->titulo }}</td>
                                        <td>{{ $resultado['nota'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </fieldset>
        </form>
    </div>
</div> <!-- fin contenedor principal-->
@endsection