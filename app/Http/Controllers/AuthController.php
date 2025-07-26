<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authorize;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Показывает форму регистрации
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Обрабатывает регистрацию пользователя
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'avatar' => 'default.png', // добавлено значение по умолчанию
        ]);

        Auth::login($user);

        return redirect('/crm');
    }

    /**
     * Авторизация пользователя
     */
    public function auth(Authorize $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Неверный логин или пароль!']
            ]);
        }

        Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        return redirect('/crm');
    }

    /**
     * Выход пользователя
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
