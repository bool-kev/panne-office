<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'nom' => 'ONEA',
                'icons' => "Images/icons/icon1.jpg"
            ],
            [
                'nom' => 'SONABEL',
                'icons'=>"Images/icons/icon2.jpg"
            ],
            [
                'nom' => 'Sapeur Pompier',
                'icons'=>"Images/icons/icon3.jpg"
            ],
        ]);
    }
}
