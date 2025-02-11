<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('villes')->insert([
            ['nom' => 'Bobo Dioulasso'],
            ['nom' => 'Ouagadougou'],
            ['nom' => 'Koudougou'],
            ['nom' => 'Fada'],
            ['nom' => 'Banfora']
        ]);
    }
}
