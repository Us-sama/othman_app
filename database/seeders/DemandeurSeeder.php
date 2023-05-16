<?php

namespace Database\Seeders;

use App\Models\Demandeur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DemandeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Demandeur::create([
                'Nom' => $faker->lastName,
                'Prenom' => $faker->firstName,
                'CIN' => $faker->unique()->numerify('########'),
                'birthdate' => $faker->date('Y-m-d', '-20 years'),
            ]);
        }
    }
}
