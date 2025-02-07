@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mis Tareas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Curso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->titulo }}</td>
                    <td>{{ $tarea->descripcion }}</td>
                    <td>{{ $tarea->curso->nombre }}</td>
                    <td>
                        @if ($tarea->tipo !== 'test')  {{-- Check if the task is NOT a test --}}
                            <a href="{{ route('tarea.test.edit', $tarea->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        @endif
                        <form action="{{ route('tarea.test.destroy', $tarea->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este test?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('tarea.test.create') }}" class="btn btn-primary">Crear nuevo test</a>
</div>
@endsection