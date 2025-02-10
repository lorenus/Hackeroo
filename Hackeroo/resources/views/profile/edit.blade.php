@extends('layouts.app')

@section('content')

@php

$colores = ['#FFD87F' => 0,'#455A64' => 0,'#EF5350' => 0,'#FFB300' => 0,'#06AAF4' => 0,'#8CC34C' => 0,'#00FF00' =>
10,'#0000FF' => 20,
'#FFFF00' => 40,'#FF00FF' => 80,'#00FFFF' => 160,'#808080' => 320];

$avatares = ['1.png' => 0,'2.png' => 0,'3.png' => 0,'4.png' => 0,'5.png' => 0,'6.png' => 0,'7.png' => 10,'8.png' => 20,
'9.png' => 40,'10.png' => 80,'11.png' => 160,'12.png' => 320];

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
        <input type="hidden" name="avatar" id="avatar" value="">


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
                                <div
                                    style="background-image: url('/img/iconos/candado.png'); background-position: center center; background-size: contain;width: 100px; height: 100px; border-radius: 20px;">
                                </div>
                                @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-5 d-flex justify-content-center">
                <div class='editar-avatar mb-5'>
                    <h5>Imagen perfil</h5>
                    <div class='row row-cols-4 g-1'>
                        @foreach ($avatares as $avatar => $valor)
                        <div class="col">
                            @if ($valor <= Auth::user()->puntos)
                                <div class="avatar-box hand-cursor" data-avatar="{{ $avatar }}"
                                    style="background-image: url('/img/avatares/{{ $avatar }}'); background-position: center center; background-size: contain;width: 100px; height: 100px; border-radius: 20px;">
                                </div>
                                @else
                                <div
                                    style="background-image: url('/img/iconos/candado.png'); background-position: center center; background-size: contain;width: 100px; height: 100px; border-radius: 20px;">
                                </div>
                                @endif
                        </div>
                        @endforeach
                    </div>
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
document.addEventListener('DOMContentLoaded', function() {
    const colorBoxes = document.querySelectorAll('.color-box');
    console.log('Número de cuadros de color:', colorBoxes.length);

    colorBoxes.forEach(function(colorBox) {
        colorBox.addEventListener('click', function() {
            const colorSeleccionado = colorBox.getAttribute('data-color');
            console.log('Color seleccionado:', colorSeleccionado);

            document.getElementById('color').value = colorSeleccionado;


            colorBoxes.forEach(function(box) {
                box.style.border = '';
            });

            colorBox.style.border = '3px solid #455A64';
            console.log('Borde actualizado para el cuadro seleccionado');
        });
    });

    const avatarBoxes = document.querySelectorAll('.avatar-box');
    console.log('Número de avatares:', avatarBoxes.length);

    avatarBoxes.forEach(function(avatarBox) {
        avatarBox.addEventListener('click', function() {
            const avatarSeleccionado = avatarBox.getAttribute('data-avatar');
            console.log('Avatar seleccionado:', avatarSeleccionado);

            document.getElementById('avatar').value = avatarSeleccionado;


            avatarBoxes.forEach(function(box) {
                box.style.border = '';
            });

            avatarBox.style.border = '3px solid #455A64';
            console.log('Borde actualizado para el cuadro seleccionado');
        });
    });
});
</script>
@endsection