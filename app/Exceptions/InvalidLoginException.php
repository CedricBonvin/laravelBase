<?php

namespace App\Exceptions;

use Exception;

class InvalidLoginException extends Exception
{
    public function report()
    {
        return false;
    }

    public function render()
    {
        return response()->json(['message' => 'The username or password is incorrect'], 422);
    }
}
