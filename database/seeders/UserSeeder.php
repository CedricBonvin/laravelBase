<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'firstname' => 'Antoine',
            'lastname' => 'KURKA',
            'username' => 'Anteke',
            'email' => 'contact@antoinekurka.fr',
            'password' => Hash::make('Evjvagea3112@'),
            'country' => 'FR',
            'timezone' => 'RDT',
            'birthdate' => Carbon::create(2000, 12, 31),
            'email_verified_at' => Carbon::now(),
        ]);

        $user->assignRole('admin');

    }
}
