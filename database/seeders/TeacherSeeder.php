<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'guru')->get();

        foreach ($users as $user) {
            Teacher::factory()->create([
            'user_id' => $user->id,
            'nama' => 'guru',
            'nip' => '123456789'. $user->id,
            ]);
        }
    }
}
