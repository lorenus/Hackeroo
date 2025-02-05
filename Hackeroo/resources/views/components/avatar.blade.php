@props([
    'src' => null,
    'alt' => '',
    'width' => null,
    'height' => null,
    'class' => '',
    'style' => '',
])

<img
    src="{{ $src }}"
    alt="{{ $alt }}"
    class="img-fluid {{ $class }}"
    style="
        @if ($width) width: {{ $width }}; @endif
        @if ($height) height: {{ $height }}; @endif
        max-width: 100px; 
        border: 3px solid #455A64; 
        border-radius: 20px; 
        object-fit: cover;
        {{ $style }}
    "
    {{ $attributes }}
/>