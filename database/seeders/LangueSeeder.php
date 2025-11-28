<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Langue;

class LangueSeeder extends Seeder
{
    public function run()
    {
        $langues = [
            ['code' => 'fon', 'nom' => 'Fon'],
            ['code' => 'yor', 'nom' => 'Yoruba'],
            ['code' => 'gou', 'nom' => 'Goun'],
            ['code' => 'bar', 'nom' => 'Bariba'],
            ['code' => 'den', 'nom' => 'Dendi'],
        ];

        foreach ($langues as $l) {
            Langue::firstOrCreate(['code' => $l['code']], $l);
        }
    }
}
