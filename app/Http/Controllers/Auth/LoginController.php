<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\EmailNotVerifiedException;
use App\Exceptions\InvalidLoginException;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends AuthController
{
    /**
     * Login user
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::query()
            ->with(['roles:name'])
            ->where('email', $validated['email'])
            ->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw new InvalidLoginException();
        }

        if (is_null($user->email_verified_at)) {
            throw new EmailNotVerifiedException();
        }

        $token = $user->createToken(config('sanctum.token_name'));

        return response()->json(['token' => $token->plainTextToken, 'user' => $user]);
    }
}
