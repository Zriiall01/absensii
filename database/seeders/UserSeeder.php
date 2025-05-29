<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('123'),
            ]
        );
        $admin->assignRole('admin');

        // Buat user Mahasiswa
        $mahasiswa = User::firstOrCreate(
            ['email' => 'mahasiswa@gmail.com'],
            [
                'name' => 'mahasiswa',
                'password' => Hash::make('123'),
            ]
        );
        $mahasiswa->assignRole('mahasiswa');

        // Buat user Dosen
        $dosen = User::firstOrCreate(
            ['email' => 'dosen@gmail.com'],
            [
                'name' => 'dosen',
                'password' => Hash::make('123'),
            ]
        );
        $dosen->assignRole('dosen');
    }
}
