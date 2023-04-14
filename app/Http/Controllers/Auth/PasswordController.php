<?php

namespace App\Http\Controllers\Auth;


use App\Exceptions\InvalidUserException;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UpdatePasswordResetRequest;
use App\Models\User;
use App\Notifications\Auth\ForgottenPasswordNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class PasswordController extends AuthController
{
    public function forgot(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->firstOr(function () {
            throw new InvalidUserException();
        });

        $verifyUrl = URL::temporarySignedRoute('password.reset', Carbon::now()->addMinutes(10), [
            'id' => $user->id,
            'hash' => Hash::make($user->email),
        ]);

        $user->notify(
            (new ForgottenPasswordNotification($verifyUrl))
        );

        return response()->noContent();
    }

    public function reset(UpdatePasswordResetRequest $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $data = $request->validated();

        $user = User::findOrFail($data['id']);
        if (!Hash::check($user->email, $data['hash'])) {
            throw new InvalidUserException();
        }

        $user->password = Hash::make($data['password']);
        $user->save();

        return response()->noContent();
    }
}
