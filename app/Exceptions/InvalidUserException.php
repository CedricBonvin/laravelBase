<?php

namespace App\Exceptions;

use Exception;

class InvalidUserException extends Exception
{
    public function report()
    {
        return false;
    }

    public function render()
    {
        return response()->json(['message' => 'The username is incorrect'], 422);
    }
}
