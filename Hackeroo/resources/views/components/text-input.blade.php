@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge(['style' => 'display: block; 
    font-family: "Itim";
    font-size: 18px;
    color: #455A64;
    width: 100%; 
    border: none; 
    border-bottom: 3px solid #FFB300; 
    background-color: transparent; 
    border-radius: 0; 
    box-shadow: none; 
    text-align: left;
    outline: none;
    padding-bottom: 0; 
    line-height: 1; 
    margin-bottom: -3px;']) }}>