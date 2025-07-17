<?php

namespace Database\Seeders;

use App\Models\Padukuhan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PadukuhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Padukuhan::create(['name' => 'Playen I']);
        Padukuhan::create(['name' => 'Playen II']);
        Padukuhan::create(['name' => 'Banaran']);
        Padukuhan::create(['name' => 'Bogor I']);
        Padukuhan::create(['name' => 'Bogor II']);
        Padukuhan::create(['name' => 'Jatisari']);
        Padukuhan::create(['name' => 'Mojosari']);
    }
}
