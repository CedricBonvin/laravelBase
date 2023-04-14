<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Situation;
use Illuminate\Database\Seeder;

class SituationSeeder extends Seeder
{
    public function run()
    {
        $situtations = [
            [
                'name' => 'À la maison',
                'slug' => 'a-la-maison',
            ],
            [
                'name' => 'Au bar',
                'slug' => 'au-bar',
            ],
            [
                'name' => 'En extérieur',
                'slug' => 'en-exterieur',
            ]
        ];
        foreach ($situtations as $situtation){
            Situation::create([
                'name' => $situtation['name'],
                'slug' => $situtation['slug'],
            ]);
        }
    }
}
