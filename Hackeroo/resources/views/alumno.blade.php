@extends('layouts.app')



@section('navbar') 
    @include('partials.navbar_alumno') 
@endsection


@section('content')
        @yield('alumno_content')
@endsection