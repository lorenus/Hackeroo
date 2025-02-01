@extends('layouts.app')

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3 text-center">  
        <label for="email" class="form-label custom-label">{{ __('Usuario') }}</label>  
        <input id="email" type="email" name="email" class="form-control custom-input border-0 border-bottom bg-transparent" value="{{ old('email') }}" required autofocus autocomplete="username">  <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="mb-3  text-center">  
        <label for="password" class="form-label text-center custom-label">{{ __('Contraseña') }}</label>  
    <input id="password" type="password" name="password" class="form-control custom-form-control border-0 border-bottom bg-transparent" required autocomplete="current-password">  <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="mb-3 form-check text-center d-flex justify-content-center align-items-center gap-2">
    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
    <label class="form-check-label" for="remember_me">
        {{ __('Remember me') }}
    </label>
</div>

    
    <div class="mt-3 mb-3 text-center">
        <x-primary-button class="ms-3  text-center">  {{ __('Log in') }}
        </x-primary-button>
    </div>

    <div class="d-flex justify-content-center flex-column gap-1 text-center">
    @if (Route::has('password.request'))
        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
            {{ __('Recordar contraseña') }}
        </a>
    @endif
    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
        {{ __('¿Eres nuevo? Regístrate aquí') }}
    </a>
</div>
</form>
@endsection