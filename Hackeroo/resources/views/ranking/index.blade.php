@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ranking de Alumnos</h1>
    <p>A continuación, verás a todos los alumnos ordenados por su número de puntos:</p>

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
@endsection
