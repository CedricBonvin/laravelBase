<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    public function run()
    {
        $equipments = [
            [
                'name' => 'Cartes',
                'slug' => 'cartes',
            ],
            [
                'name' => 'Dés',
                'slug' => 'des',
            ]
        ];
        foreach ($equipments as $equipment){
            Equipment::create([
                'name' => $equipment['name'],
                'slug' => $equipment['slug'],
            ]);
        }
    }
}
