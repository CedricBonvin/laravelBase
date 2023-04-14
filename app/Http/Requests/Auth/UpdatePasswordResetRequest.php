<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordResetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|min:1',
            'hash' => 'required|string',
            'password' => ['required', 'confirmed', Password::min(8)],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
