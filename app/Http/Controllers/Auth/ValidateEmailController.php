<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\EmailVerificationCustomRequest;
use App\Models\User;

class ValidateEmailController extends AuthController
{
    public function __invoke(EmailVerificationCustomRequest $request)
    {
        $request->fulfill();

        $userId = $request->route('id');

        $user = User::findOrfail($userId);

        if($user->hasVerifiedEmail()) {
            return response()->json([
                'type' => 'success',
                'message' => 'Votre compte a bien été validé',
            ], 200);
        }
        else {
            return response()->json([
                'type' => 'error',
                'message' => 'Une erreur est survenue',
            ], 403);
        }
    }
}
{

}
