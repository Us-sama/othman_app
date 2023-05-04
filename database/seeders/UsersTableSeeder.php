<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'role' => 'agent',
            ],
            // [
            //     'name' => 'Othman Bertal',
            //     'email' => 'othmanbertal@example.com',
            //     'password' => Hash::make('password'),
            //     'role' => 'chef',
            // ],
            // Add more user data as needed
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);
            $user->assignRole($userData['role']);
        }
        // $user = User::create([
        //     'name' => 'Othman Bertal',
        //     'email' => 'othmanbertal@example.com',
        //     'password' => bcrypt('password'),
        // ]);

        // $user->assignRole('chef');
    }
}
