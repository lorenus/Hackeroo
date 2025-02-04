@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $curso->nombre }}</h1>
    <p>{{ $curso->descripcion }}</p>

    <h2>Tareas</h2>
    @if($curso->tareas->isEmpty())
        <p>No hay tareas en este curso.</p>
    @else
        <ul class="list-group">
            @foreach($curso->tareas as $tarea)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $tarea->titulo }}</strong>
                    </div>
                    <div>
                        @if($tarea->tipo === 'test')
                   
                            <form action="{{ route('tarea.eliminar', $tarea->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">Eliminar Test</button>
                            </form>
                        @elseif($tarea->tipo === 'archivo')
                           <!--   <a href="{{ route('tarea.archivo.edit', $tarea->id) }}" class="btn btn-sm btn-warning">Editar Archivo</a>-->


                            <form action="{{ route('tarea.eliminar', $tarea->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">Eliminar Archivo</button>
                            </form>
                        @elseif($tarea->tipo === 'link')
                           <!-- <a href="{{ route('tarea.link.edit', $tarea->id) }}" class="btn btn-sm btn-warning">Editar Link</a>-->
                            <form action="{{ route('tarea.eliminar', $tarea->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">Eliminar Link</button>
                            </form>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('tarea.create', ['curso_id' => $curso->id]) }}" class="btn btn-success mt-3">Añadir Tarea</a>

    <a href="{{ route('cursos') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection

