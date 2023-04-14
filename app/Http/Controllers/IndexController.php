<?php

namespace App\Http\Controllers;

use App\Services\IndexService;

class IndexController extends Controller
{
    private IndexService $indexService;
    public function __construct(IndexService $indexService)
    {
        $this->indexService = $indexService;
    }

    public function getIndexStats()
    {
        return response()->json([
            'games_count' => $this->indexService->getGamesCount(),
            'users_count' => $this->indexService->getUsersCount(),
        ]);
    }
}
