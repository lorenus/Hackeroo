<button {{ $attributes->merge([
    'type' => 'submit', 
    'style' => 'border: none; 
        background-color: transparent; 
        font-family: "Lilita One"; 
        margin-top: -7px; 
        color: #FEFFEB; 
        font-size: x-large; 
        background-position: center 5px; 
        background-image: url("/img/botones/boton.png"); 
        background-size: contain; 
        background-repeat: no-repeat; 
        width: 180px; 
        height: 60px; 
        display: inline-block; 
        padding: 10px 20px; 
        text-align: center; 
        text-decoration: none;',
    'class' => 'hand-cursor', 
]) }}>
    {{ $slot }}
</button>