<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string',
            'password' => ['required', 'confirmed', Password::min(8)],
            'country' => 'required|string',
            'birthdate' => 'required|date'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
