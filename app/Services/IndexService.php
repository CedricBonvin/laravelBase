<?php

namespace App\Services;

use App\Models\Game;
use App\Models\User;

class IndexService
{
    public function getGamesCount()
    {
        return Game::count();
    }

    public function getUsersCount()
    {
        return User::count();
    }
}
