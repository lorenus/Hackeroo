@props([
    'disabled' => false,
    'min' => 1, 
    'max' => 25, 
    'step' => null, 
])

<input
    type="number"
    @disabled($disabled)
    {{ $attributes->merge([
        'style' => 'display: block;
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
            margin-bottom: -3px;'
    ]) }}
    @if ($min !== null) min="{{ $min }}" @endif  
    @if ($max !== null) max="{{ $max }}" @endif 
    @if ($step !== null) step="{{ $step }}" @endif 
>