@props([
    'color' => '#ffffff', // Color de fondo (predeterminado: blanco)
    'width' => '75px',   // Ancho del div (predeterminado: 100px)
    'height' => '75px',  // Alto del div (predeterminado: 100px)
])

<div
    {{ $attributes->merge([
        'style' => 
        "background-color: {$color}; 
        width: {$width}; 
        height: {$height};
        border-radius: 20px;"
    ]) }}
>
    {{ $slot }}
</div>