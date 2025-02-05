@props([
    'disabled' => false,
    'options' => [], // Opciones del select
    'selected' => null, // Opción seleccionada por defecto
])

<select
    {{ $attributes->merge([
        'style' => '
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            border: none;
            background: transparent;
            font-family: "Itim";
            font-size: 18px;
            color: #455A64;
            width: 100%;
            outline: none;
            cursor: pointer;
        ',
    ]) }}
    @disabled($disabled)
>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>