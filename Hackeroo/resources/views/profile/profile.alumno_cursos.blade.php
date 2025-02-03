{{-- resources/views/profile/alumno_cursos.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Mis Cursos</h1>
    <ul>
        @foreach($cursos as $curso)
            <li>{{ $curso->nombre }} - {{ $curso->descripcion }}</li>
        @endforeach
    </ul>
@endsection
