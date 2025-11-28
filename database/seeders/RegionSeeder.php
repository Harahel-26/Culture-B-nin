<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    public function run()
    {
        $regions = [
            ['nom' => 'Atacora', 'type' => 'Département', 'langue_principale' => 'bar'],
            ['nom' => 'Donga', 'type' => 'Département', 'langue_principale' => 'yor'],
            ['nom' => 'Zou', 'type' => 'Département', 'langue_principale' => 'fon'],
            ['nom' => 'Mono', 'type' => 'Département', 'langue_principale' => 'gou'],
            ['nom' => 'Collines', 'type' => 'Département', 'langue_principale' => 'yor'],
        ];

        foreach ($regions as $region) {
            Region::firstOrCreate(['nom' => $region['nom']], $region);
        }
    }
}
