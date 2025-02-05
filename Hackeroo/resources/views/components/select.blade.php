@props([
    'disabled' => false,
    'options' => [],
    'selected' => null,
    'customClass' => '', // Nueva prop para clases personalizadas
])

<div class="select-wrapper {{ $customClass }}">  <select
        {{ $attributes->merge([
            'class' => 'form-control custom-select', // Clase de Bootstrap + custom
            'style' => '
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
                background-image: url("data:image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27%3e%3cpath fill=%27%23455a64%27 d=%27M7 10l5 5 5-5z%27/%3e%3c/svg%3e"); /* Flecha personalizada */
                background-repeat: no-repeat;
                background-position: right 10px center;
                background-size: 1.5em 1.5em; /* Ajusta tamaño de la flecha */
                padding-right: 30px; /* Espacio para la flecha */
                font-family: "Itim";
                font-size: 18px;
                color: #455A64;
                width: 100%;
                outline: none;
                cursor: pointer;
                border: none;
                padding: 0.375rem 0.75rem; /* Ajusta el padding */
                border-radius: 0.25rem; /* Bordes redondeados */
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
</div>