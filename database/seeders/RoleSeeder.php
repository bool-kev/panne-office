<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('roles')->insert([
                ['nom' => 'citoyen'],
                ['nom' => 'operateur'],
                ['nom' => 'admin'],
            ]);

            DB::table('statuts')->insert([
                ['nom' => 'en attende de reception'],
                ['nom' => 'en cours de traitement'],
                ['nom' => 'traiter'],
                ['nom'=>'rejeter']
            ]);
    }
}
