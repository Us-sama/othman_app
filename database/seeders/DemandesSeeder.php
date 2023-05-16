<?php

namespace Database\Seeders;

use App\Models\Demande;
use App\Models\Demandeur;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DemandesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Demande::create([
                'demandeur_id' => Demandeur::all()->random()->id,
                'status' => $faker->randomElement(['En attente', 'Approuvé', 'Payé/en cours']),
                'demand_files' => $faker->file('path/to/demand_files', 'storage/app'),
                'created_by' => User::all()->random()->id,
                'payment_file' => $faker->file('path/to/payment_files', 'storage/app'),
            ]);
        }
    }
}
