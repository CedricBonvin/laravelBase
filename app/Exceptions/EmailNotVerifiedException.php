<?php

namespace App\Exceptions;

use Exception;

class EmailNotVerifiedException extends Exception
{
    public function report()
    {
        return false;
    }

    public function render()
    {
        return response()->json(['message' => 'You must verify your email first'], 400);
    }
}
