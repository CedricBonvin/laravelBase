<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;

abstract class AuthController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }
}
