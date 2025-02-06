@props([
    'src' =>'',
    'alt' => '',
    'width' => null,
    'height' => null,
    'class' => '', 
])
<img
    src="{{ $src }}"
    alt="{{ $alt }}"
    class="img-fluid {{ $class }} @if ($width) w-{{ $width }} @endif @if ($height) h-{{ $height }} @endif"
    style="
        max-width: 100px;
        border: 3px solid #455A64;
        border-radius: 20px;
        object-fit: cover;
    "
    {{ $attributes }}
/>