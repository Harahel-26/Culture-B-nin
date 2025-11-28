<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContenuTraduction;

class ContenuTraductionSeeder extends Seeder
{
    public function run(): void
    {
        ContenuTraduction::factory()->count(20)->create();
    }
}
