@extends('layouts.app')

@section('content')

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div class="text-center">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Indica tu correo y te enviaremos un enlace de recuperación.') }}
        </div>
        <x-input-label for="email" :value="__('Email:')" class="text-center" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4 text-center">
        <x-primary-button>
            {{ __('Enviar') }}
        </x-primary-button>
    </div>
</form>

@endsection