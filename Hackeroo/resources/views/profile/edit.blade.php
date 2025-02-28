@extends('layouts.app')

@section('content')
@php
$colores = ['#6AA9CF' => 0,'#D58FCA' => 0,'#254E63' => 0,'#D3B92D' => 0,'#99334F' => 0,'#6F8B14' => 0,'#D39B6C' => 10,'#8C7DC7' => 20, '#BD65B7' => 40,'#C96C1C' => 80,'#AED44C' => 160,'#808080' => 320];

$avatares = ['1.png' => 0,'2.png' => 0,'3.png' => 0,'4.png' => 0,'5.png' => 0,'6.png' => 0,'7.png' => 10,'8.png' => 20, '9.png' => 40,'10.png' => 80,'11.png' => 160,'12.png' => 320];
@endphp

<div class="container mt-md-5 pb-5 " style='max-height; 50vh; overflow-y:scroll;'>
    <div class="row mb-3 volver">
        <div class="col-6 col-md-12 text-left">
            <a href="{{ route('perfil') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <div class="col-6 col-md-12 text-left">
        <h2 class='text-center mb-3'>Editar Perfil</h2>
    </div>

    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="color" id="color" value="">
        <input type="hidden" name="avatar" id="avatar" value="">

        <div class="row gap-5 d-flex justify-content-center">
            <!-- Sección de colores -->
            <div class="col-md-5 col-12 mb-4 mb-md-0">
                <h5 class="text-center mb-3">Color del perfil</h5>
                <div class="row row-cols-4 g-2">
                    @foreach ($colores as $color => $valor)
                    <div class="col d-flex justify-content-center">
                        @if ($valor <= Auth::user()->puntos)
                            <div class="color-box hand-cursor p-3 text-center ratio ratio-1x1" data-color="{{ $color }}" style="background-color: {{ $color }}; border-radius: 20px; max-width: 80px; max-height: 80px;">
                            </div>
                            @else
                            <div class="p-3 text-center ratio ratio-1x1" style="background-image: url('/img/iconos/candado.png'); background-position: center center; background-size: contain; border-radius: 20px; max-width: 80px; max-height: 80px;">
                            </div>
                            @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Sección de avatares -->
            <div class="col-md-5 col-12 mb-3 mb-md-0">
                <h5 class="text-center mb-3">Imagen perfil</h5>
                <div class="row row-cols-4 g-2">
                    @foreach ($avatares as $avatar => $valor)
                    <div class="col d-flex justify-content-center">
                        @if ($valor <= Auth::user()->puntos)
                            <div class="avatar-box hand-cursor p-3 text-center ratio ratio-1x1" data-avatar="{{ $avatar }}" style="background-image: url('/img/avatares/{{ $avatar }}'); background-size: cover; background-position: center; border-radius: 20px; max-width: 80px;  max-height: 80px;">
                            </div>
                            @else
                            <div class="p-3 text-center ratio ratio-1x1" style="background-image: url('/img/iconos/candado.png'); background-position: center center; background-size: contain; border-radius: 20px; max-width: 80px; max-height: 80px;">
                            </div>
                            @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center mt-5">
            <x-primary-button type="submit" class="btn btn-primary">Actualizar</x-primary-button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("Script cargado correctamente."); // Depuración

        // Seleccionar los cuadros de color
        const colorBoxes = document.querySelectorAll('.color-box');
        console.log("Cuadros de color encontrados:", colorBoxes.length); // Depuración

        colorBoxes.forEach(function(colorBox) {
            colorBox.addEventListener('click', function() {
                console.log("Cuadro de color clickeado:", colorBox); // Depuración
                const colorSeleccionado = colorBox.getAttribute('data-color');
                document.getElementById('color').value = colorSeleccionado;

                // Quitar el borde de todos los cuadros de color
                colorBoxes.forEach(function(box) {
                    box.style.border = '';
                });

                // Añadir borde al cuadro seleccionado
                colorBox.style.border = '3px solid #455A64';
                console.log("Borde añadido al cuadro seleccionado:", colorBox); // Depuración
            });
        });

        // Seleccionar los cuadros de avatar
        const avatarBoxes = document.querySelectorAll('.avatar-box');
        console.log("Cuadros de avatar encontrados:", avatarBoxes.length); // Depuración

        avatarBoxes.forEach(function(avatarBox) {
            avatarBox.addEventListener('click', function() {
                console.log("Cuadro de avatar clickeado:", avatarBox); // Depuración
                const avatarSeleccionado = avatarBox.getAttribute('data-avatar');
                document.getElementById('avatar').value = avatarSeleccionado;

                // Quitar el borde de todos los cuadros de avatar
                avatarBoxes.forEach(function(box) {
                    box.style.border = '';
                });

                // Añadir borde al cuadro seleccionado
                avatarBox.style.border = '3px solid #455A64';
                console.log("Borde añadido al cuadro seleccionado:", avatarBox); // Depuración
            });
        });
    });
</script>
@endsection