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
        <form action="#" method="">
            @csrf
            <fieldset>
                <legend>{{ $alumno->nombre }} {{ $alumno->apellidos }}</legend>
                <div class="tabla-scroll-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Ejercicio</th>
                                <th>Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>3</td>
                                <td>7</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>4</td>
                                <td>6</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </form>
    </div>
</div> <!-- fin contenedor principal-->

@endsection