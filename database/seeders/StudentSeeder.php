<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'siswa')->get();
        
        foreach ($users as $user) {
            Student::factory()->create([
                'user_id' => $user->id,
                'nama' => 'siswa 1',
                'nis' => '1234' . $user->id,
                'kelas' => rand(1, 12),
            ]);
        }
    }
}
