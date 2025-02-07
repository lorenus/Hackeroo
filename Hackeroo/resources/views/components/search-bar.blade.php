@props(['disabled' => false])

<div style="position: relative; width: 100%;">
    <input 
        @disabled($disabled) 
        {{ $attributes->merge(['style' => 'display: block; 
        font-family: "Itim";
        font-size: 18px;
        color: #455A64;
        width: 100%; 
        background-color: #FFB300; 
        border-radius: 20px; 
        box-shadow: none; 
        text-align: left;
        outline: none;
        padding-bottom: 5px; 
        margin-bottom: -5px;
        padding-right: 40px;']) }}> 

    <!-- Icono de lupa -->
    <img 
        src="/img/iconos/lupa.png" 
        alt="Buscar" 
        style="position: absolute; 
               right: 30px; 
               top: 50%; 
               transform: translateY(-50%); 
               height: 20px; 
               width: 20px;
               margin-top:2px;
              ">
</div>