<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    public function run()
    {
        $regions = [
            ['nom' => 'Atacora', 'type' => 'Département'],
            ['nom' => 'Donga', 'type' => 'Département'],
            ['nom' => 'Zou', 'type' => 'Département'],
            ['nom' => 'Mono', 'type' => 'Département'],
            ['nom' => 'Collines', 'type' => 'Département'],
        ];

        foreach ($regions as $region) {
            Region::firstOrCreate(['nom' => $region['nom']], $region);
        }
    }
}
