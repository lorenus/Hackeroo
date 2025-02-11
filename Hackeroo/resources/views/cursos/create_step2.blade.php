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
    <div class='d-flex justify-content-center'>
    <fieldset class="reset">
        <legend class="reset">Nuevo curso</legend>
        <div class="mb-5 mt-3 text-md-center">
            <h6>Selecciona los alumnos que quieras añadir</h6>

            <div class="input-group mb-4">
                <x-search-bar id="search" class="form-control" placeholder="Buscar alumno por nombre o apellidos" />
            </div>

            <div class="mb-5 mt-3 text-md-start">
                <div class="mb-3">
                    <form action="{{ route('cursos.store.step2') }}" method="POST">
                        @csrf
                        <div class="tabla-scroll-container"> 
                            <table id="alumnos-table"> 
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>DNI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alumnos as $alumno)
                                    <tr class="alumno-row">
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
    </div>
</div>

<script>
    function filterAlumnos() {
        const searchTerm = document.getElementById('search').value.toLowerCase();
        const rows = document.querySelectorAll('.alumno-row');

        if (searchTerm === "") {
            rows.forEach(row => {
                row.style.display = ''; 
            });
        } else {
            rows.forEach(row => {
                const nombre = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const dni = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

              
                if (nombre.includes(searchTerm) || dni.includes(searchTerm)) {
                    row.style.display = ''; 
                } else {
                    row.style.display = 'none'; 
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        if (searchInput) {
            searchInput.addEventListener('input', filterAlumnos); 
        }
    });
</script>
@endsection
