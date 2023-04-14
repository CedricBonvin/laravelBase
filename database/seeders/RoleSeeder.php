<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = RoleEnum::cases();
        foreach ($roles as $role){
            Role::create([
                'name' => RoleEnum::getRole($role),
                'guard_name' => 'api',
            ]);
        }
    }
}
