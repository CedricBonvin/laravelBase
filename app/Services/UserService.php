<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Mail\NewUserMail;
use App\Models\User;
use App\Supports\ApiService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService
{

    protected ApiService $userApi;

    public function __construct()
    {
        $this->userApi = new ApiService(User::class);
    }

    public function getUser(int $id)
    {
        return $this->getUserQuery()
            ->findOrFail($id);
    }

    protected function getUserQuery()
    {
        return $this->userApi->initQuery();
    }

    public function registerUser(array $data): User
    {
        $user = new User();
        $user->fill($data);

        $user->password = Hash::make($data['password']);
        $user->save();

        event(new Registered($user));

        $user->assignRole(RoleEnum::getRole(RoleEnum::USER));

        //generate a hashed token with the username, the email, the firstname and the lastname
        //$user->markEmailAsVerified();

        // send mail to user
        /*Mail::to($user->email)
            ->send(new NewUserMail($user));*/

        return $user;
    }

    public function update(User $user, array $data): User
    {
        $user->fill($data);
        $user->save();

        return $user;
    }

    public function updateAvatar(User $user, $avatar): User
    {
        $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(public_path('avatars'), $avatarName);

        $user->avatar = $avatarName;
        $user->save();

        return $user;
    }

    public function changePassword(User $user, array $data): User
    {
        $user->password = Hash::make($data['password']);
        $user->save();

        return $user;
    }


}
