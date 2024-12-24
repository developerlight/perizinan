<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()->admin()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // User::factory()->teacher()->create([
        //     'email' => 'guru@example.com',
        // ]);

        // User::factory()->student()->create([
        //     'email' => 'siswa@example.com',
        // ]);
    }
}
