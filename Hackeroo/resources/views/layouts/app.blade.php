<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="..." crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @vite(['resources/css/style.css'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @if(auth()->check())
            @if(auth()->user()->rol === 'profesor')
                @include('layouts.nav-profesor')
            @elseif(auth()->user()->rol === 'alumno')
                @include('layouts.nav-alumno')
            @endif
        @else
            @include('layouts.navigation')
        @endif


  <div class="contenido container-fluid d-flex flex-column flex-md-row p-5">
  @yield('content')
</div>
        @include('layouts.footer')
    </div>




    @vite(['resources/js/animaciones.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html> 