<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->select('firstname', 'lastname', 'email', 'id', 'username', 'created_at')
            ->with('roles')
        ;

        $users = $query->paginate(10);

        return response()->json($users);
    }
}
