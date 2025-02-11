<?php

namespace Database\Seeders;

use App\Models\Operateur;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ville;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([ VilleSeeder::class, RoleSeeder::class, NoteSeeder::class,ServiceSeeder::class ]);
        // User::factory(10)->create();

        


        foreach(Service::all() as $service) {
            $service->dept_seed()->attach(Ville::all()->shuffle()->take(2)->pluck('id')->toArray());
        }
        User::create([
            'email' => 'admin@test.com',
            'password'=>Hash::make('admin'),
            'role_id' => 3,
        ]);
        
        $user=User::create([
            'email' => 'operateur@test.com',
            'password'=>Hash::make('kali'),
            'role_id' => 2,
        ]);

        Operateur::create([
            'departement_id' => 1,
            'user_id'=>$user->id
        ]);
    }
}
