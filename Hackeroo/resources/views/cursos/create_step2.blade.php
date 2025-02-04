@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-3 volver">
        <div class="col-12 text-left">
            <a href="{{ route('perfil') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>
    <fieldset class="reset">
        <legend class="reset">Nuevo curso</legend>
        <div class="mb-5 mt-3 text-md-start">
            <h6>Selecciona los alumnos que quieras añadir</h6>

            <div class="mb-5 mt-3 text-md-start">
    <div class="mb-3">
        <form action="{{ route('cursos.store.step2') }}" method="POST">
            @csrf
            <div class="tabla-scroll-container"> <!-- Contenedor para el scroll -->
                <table> <!-- Eliminamos la clase .tabla-scroll -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>DNI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnos as $alumno)
                        <tr>
                            <td>
                                <input type="checkbox" name="alumnos[]" value="{{ $alumno->DNI }}">
                            </td>
                            <td>{{ $alumno->nombre }} {{ $alumno->apellidos }}</td>
                            <td>{{ $alumno->DNI }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 mt-3 text-center mt-4">
                <x-primary-button type="submit">Crear curso</x-primary-button>
            </div>
        </form>
    </div>
</div>
            
    </fieldset>











    </form>
</div>
@endsection