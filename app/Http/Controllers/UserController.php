<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function update(UpdateUserRequest $request){
        $data = $request->validated();
        $user = $request->user();

        $updatedUser = $this->userService->update($user, $data);

        return response()->json($updatedUser);
    }

    public function updateAvatar(UpdateAvatarRequest $request){
        $data = $request->validated();
        $user = $request->user();

        $updatedUser = $this->userService->updateAvatar($user, $data);

        return response()->json($updatedUser);
    }

    public function changePassword(ChangePasswordRequest $request){
        $data = $request->validated();
        $user = $request->user();

        $updatedUser = $this->userService->changePassword($user, $data);

        return response()->json($updatedUser);
    }
}
