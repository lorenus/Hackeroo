@props(['disabled' => false])

<textarea
    @disabled($disabled)
    {{ $attributes->merge(['style' => 'display: block; 
    margin-top: 0.25rem; 
    width: 100%; 
    border:none;
    margin-bottom: 15px;
    min-height: 100px; 
    padding-top: 2px; 
    font-family: "Itim"; 
    font-size: 18px;
    outline: none;
    box-shadow: none; 
    color: #455A64;
    line-height: 26px; 
    background: repeating-linear-gradient(transparent, transparent 23px, #FFB300 23px, #FFB300 26px); 
    resize: vertical;']) }}
>{{ $slot }}</textarea>