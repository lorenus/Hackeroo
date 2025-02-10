@extends('layouts.app')

@section('content')

@php
// Declara la variable $colores aquí para que esté disponible en toda la vista
$colores = [
'#FFD87F' => 0,
'#455A64' => 0,
'#EF5350' => 0,
'#FFB300' => 0,
'#06AAF4' => 0,
'#8CC34C' => 0,
'#00FF00' => 10,
'#0000FF' => 20,
'#FFFF00' => 40,
'#FF00FF' => 80,
'#00FFFF' => 160,
'#808080' => 320
];
@endphp

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
        <input type="hidden" name="color" id="color" value="">

        <!-- Resto del formulario -->
        <div class="row justify-content-center gx-5">
            <div class="col-md-5 d-flex justify-content-center">
                <div class='editar-color mb-5'>
                    <h5>Color del perfil</h5>
                    <div class='row row-cols-4 g-1'>
                        @foreach ($colores as $color => $valor)
                        <div class="col">
                            @if ($valor <= Auth::user()->puntos)
                                <div class="color-box hand-cursor" data-color="{{ $color }}"
                                    style="background-color: {{ $color }}; width: 100px; height: 100px; border-radius: 20px;">
                                </div>
                                @else
                                <div style="position: relative;">
                                    <div
                                    style="background-image: url('/img/iconos/candado.png'); background-position: center center; background-size: contain;width: 100px; height: 100px; border-radius: 20px;">
                                    </div>
    
                                </div>
                                @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="col-md-5 d-flex justify-content-center">
                <div class='editar-avatar'>
                    <h5>Imagen de perfil</h5>
                    <div class='row row-cols-3 g-2 justify-content-center'>
                        @for ($i = 1; $i < 8; $i++) <div class="col">
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
    <x-primary-button type="submit" class="btn btn-primary mt-5 text-center">Actualizar</x-primary-button>
</div>
</form>
</div>
<script>
     document.addEventListener('DOMContentLoaded', function () {
        const colorBoxes = document.querySelectorAll('.color-box');
        console.log('Número de cuadros de color:', colorBoxes.length); 
    
        colorBoxes.forEach(function (colorBox) {
            colorBox.addEventListener('click', function () {
                const colorSeleccionado = colorBox.getAttribute('data-color');
                console.log('Color seleccionado:', colorSeleccionado); 
    
                document.getElementById('color').value = colorSeleccionado;
    

                colorBoxes.forEach(function (box) {
                    box.style.border = ''; 
                });
    
                colorBox.style.border = '3px solid #455A64';
                console.log('Borde actualizado para el cuadro seleccionado');
            });
        });
    });
</script>
@endsection