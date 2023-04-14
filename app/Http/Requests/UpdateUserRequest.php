<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->user()->id,
            'country' => 'required|string',
            'birthdate' => 'required|date',
            'timezone' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
