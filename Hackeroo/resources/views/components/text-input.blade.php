@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge(['style' => 'display: block; 
    margin-top: 0.25rem; 
    width: 100%; 
    border: none; 
    border-bottom: 3px solid #FFB300; 
    background-color: transparent; 
    border-radius: 0; 
    box-shadow: none; 
    padding: 0.5rem 0; 
    text-align: left;
    margin-top:-5px;']) }}>
