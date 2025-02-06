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

    <h2 class='text-center mb-3'>Editar Perfil</h2>

    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row justify-content-center gx-5">  
            <div class="col-md-5 d-flex justify-content-center">
                <div class='editar-color mb-5'>
                    <h5>Color del perfil</h5>
                    <div class='row row-cols-4 g-1'>  
                    @php
                        $colores = [
                        '#FFD87F',
                        '#455A64',
                        '#EF5350',
                        '#FFB300',
                        '#06AAF4',
                        '#8CC34C',
                        '#00FF00',
                        '#0000FF',
                        '#FFFF00',
                        '#FF00FF',
                        '#00FFFF',
                        '#808080'
                        ];
                        @endphp
                        @foreach ($colores as $color)
                            <div class="col">
                                <x-color-box color="{{ $color }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-5 d-flex justify-content-center">
                <div class='editar-avatar'>
                    <h5>Imagen de perfil</h5>
                    <div class='row row-cols-3 g-2 justify-content-center'>
                        @for ($i = 1; $i < 8; $i++)
                            <div class="col">
                                <x-avatar src="/img/avatares/{{ $i }}.png"></x-avatar>
                            </div>
                        @endfor
                        <div class="col">
                            <x-avatar src="/img/iconos/candado.png"></x-avatar>
                        </div>
                        <div class="col">
                            <x-avatar src="/img/iconos/candado.png"></x-avatar>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <x-primary-button type="submit" class="btn btn-primary mt-5 text-center">Actualizar Perfil</x-primary-button>
        </div>
    </form>
</div>
@endsection