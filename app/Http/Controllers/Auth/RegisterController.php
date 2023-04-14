<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class RegisterController extends AuthController
{
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->validated();

        if (User::where('email', $request->input('email'))->exists()) {
            return response()->json([
                'type' => 'error',
                'message' => 'Ce compte existe déjà',
            ], 403);
        }

        $user = $this->userService->registerUser($data);

        return response()->json($user);
    }
}
