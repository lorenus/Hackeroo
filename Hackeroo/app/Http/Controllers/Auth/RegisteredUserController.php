<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    $request->validate([
        'DNI' => 'required|string|unique:usuarios,DNI',
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:usuarios,email',
        'password' => 'required|string|confirmed|min:8',
        'rol' => 'in:alumno,profesor',
        'puntos' => 'nullable|integer',
        'color' => 'nullable|string',
        'avatar' => 'nullable|string',
    ]);


    // Calcular los puntos según el rol
    $puntos = $request->rol === 'profesor' ? 1000 : 0;

    // Crear el usuario
    $user = Usuario::create([
        'DNI' => $request->DNI,
        'nombre' => $request->nombre,
        'apellidos' => $request->apellidos,
        'email' => $request->email,
        'contraseña' => Hash::make($request->password),
        'rol' => $request->rol ?? 'alumno',
        'puntos' => $puntos, // Usa el valor calculado
        'color' => $request->color ?? '#06AAF4', // Valor por defecto si no se proporciona
        'avatar' => $request->avatar ?? '1.png', // Valor por defecto si no se proporciona
    ]);

    // Autenticación automática tras el registro
    Auth::login($user);

    return redirect()->route('perfil');
}}