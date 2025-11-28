<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeMedia;

class TypeMediaSeeder extends Seeder
{
    public function run()
    {
        $medias = [
            'image',
            'video',
            'audio',
            'texte',
            'pdf',
            'document',
            'archive',
        ];

        foreach ($medias as $m) {
            TypeMedia::firstOrCreate(['nom' => $m]);
        }
    }
}
