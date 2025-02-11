@props(['disabled' => false, 'label' => null])

<div class="mb-3">  @if ($label)
        <label for="{{ $attributes->get('id') }}" class="form-label text-gris">{{ $label }}</label>
    @endif
    <input
        type="file"
        @disabled($disabled)
        {{ $attributes->merge([
            'class' => 'form-control file-input', 
        ]) }}
    >
</div>

<style>
.file-input {
    font-family: 'Lilita One';
    font-size: 18px;
    color: #455A64; 
    background-color: transparent;
    border: 3px solid #FFB300; 
    border-radius: 20px; 
    padding: 0.5rem 0.75rem; 
    box-shadow: none; 
    outline: none; 
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; /* Transición suave */
}

.file-input:focus {
    border-color: #FFB300; /* Borde amarillo al hacer focus */
    box-shadow: 0 0 0 0.2rem rgba(255, 179, 0, 0.25); /* Sombra amarilla suave al hacer focus */
}

.text-gris {
    color: #455A64; 
}
</style>