<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('notes')->insert([
                ['nom' => 'A refaire'],
                ['nom' => 'Insatisfait'],
                ['nom' => 'Satisfaisant'],
                ['nom' => 'Efficace'],
                ['nom' => 'Professionnel'],
            ]);
    }
}
