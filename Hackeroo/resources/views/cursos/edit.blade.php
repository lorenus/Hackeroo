@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row mb-3 volver">
        <div class="col-12 text-left">
            <a href="{{ route('cursos') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <h2 class='text-center'>Editar {{ $curso->nombre }}</h2>
  

    <div class='row'>
        <div class='col-12 col-md-6'>
            <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5 mt-3 text-md-start">
                    <x-input-label for="nombre" :value="__('Nombre del curso:')" />
                    <x-text-input id="nombre" class="form-control block" type="text" name="nombre"
                        :value="old('nombre', $curso->nombre) " maxlength=25 required />
                </div>

                <div class="mb-5 mt-3 text-md-start">
                    <x-input-label for="descripcion" :value="__('Descripción:')" />
                    <x-text-area class="form-control" id="descripcion" name="descripcion">
                        {{ old('descripcion', $curso->descripcion) }}
                    </x-text-area>
                </div>
        </div>

        <div class='col-12 col-md-6'>
            <div class="mt-3 text-md-start">
                <h6>Selecciona los alumnos que quieras añadir:</h6>

                <div class="input-group mb-4">
                    <x-search-bar id="search" class="form-control" placeholder="Buscar alumno" />
                </div>

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
                                    <input type="checkbox" name="alumnos[]" value="{{ $alumno->DNI }}"
                                        {{ $cursos_alumnos->contains($alumno->DNI) ? 'checked' : '' }}>
                                </td>
                                <td>{{ $alumno->nombre }} {{ $alumno->apellidos }}</td>
                                <td>{{ $alumno->DNI }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
               
            </div>
            
        </div>
        <div class="col-12 text-center ">
                    <x-primary-button type="submit">Actualizar</x-primary-button>
                </div> </form>
    </div>

    <script>
    function filterAlumnos() {
        const searchTerm = document.getElementById('search').value.toLowerCase();
        const rows = document.querySelectorAll('.alumno-row');

        rows.forEach(row => {
            const nombre = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const apellidos = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

            if (searchTerm === "" || nombre.includes(searchTerm) || apellidos.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        if (searchInput) {
            searchInput.addEventListener('input', filterAlumnos); // Correct event listener
        }
    });
    </script>
</div>
@endsection