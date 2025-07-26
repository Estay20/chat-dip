<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Authorize extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|exists:users,email',
            'password' => 'required|string|min:6',
        ];
    }

    /**
     * Create and log in the user after validation.
     *
     * @param  array  $validated
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUserAndLogin(array $validated)
    {
        $user = new User();
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);  // Хеширование пароля
        $user->save();

        // Логика после сохранения (например, аутентификация)
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    /**
     * Get custom validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email - обязательное поле!',
            'email.exists' => 'Такого email не существует',
            'password.required' => 'Пароль - обязательное поле!',
        ];
    }
}
