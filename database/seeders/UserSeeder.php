<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 👨‍💼 Admin utama
        User::create([
            'name' => 'Admin KaloriKita',
            'email' => 'admin@kalorikita.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // 👥 User dummy (Indonesia)
        $users = [
            ['name' => 'Rizki Saputra', 'email' => 'rizki@example.com'],
            ['name' => 'Citra Lestari', 'email' => 'citra@example.com'],
            ['name' => 'Andi Pratama', 'email' => 'andi@example.com'],
            ['name' => 'Nanda Permata', 'email' => 'nanda@example.com'],
            ['name' => 'Bagus Santoso', 'email' => 'bagus@example.com'],
            ['name' => 'Dewi Anggraini', 'email' => 'dewi@example.com'],
            ['name' => 'Fajar Maulana', 'email' => 'fajar@example.com'],
            ['name' => 'Putri Ayu', 'email' => 'putri@example.com'],
            ['name' => 'Arif Wibowo', 'email' => 'arif@example.com'],
            ['name' => 'Sari Ramadhani', 'email' => 'sari@example.com'],
        ];

        foreach ($users as $u) {
            User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => Hash::make('user123'), // password default
                'role' => 'user',
                'no_hp' => '08' . rand(111111111, 999999999),
                'alamat' => fake('id_ID')->address(),
            ]);
        }
    }
}
