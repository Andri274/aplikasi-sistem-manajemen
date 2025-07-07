<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder user.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Dicky Dwi Subagja',
                'no_hp' => '082111629611',
                'email' => 'internalhbl01@gmail.com',
                'password' => bcrypt('Hbl001'),
                'tipe_user' => 'internal_hbl'
            ],
            [
                'name' => 'Enok Marlin',
                'no_hp' => '0812345678910',
                'email' => 'enokmarlin50@gmail.com',
                'password' => bcrypt('Hbl0099'),
                'tipe_user' => 'vendor'
            ],
            [
                'name' => 'Yusman',
                'no_hp' => '083125269626',
                'email' => 'internalhbl02@gmail.com',
                'password' => bcrypt('Hbl002'),
                'tipe_user' => 'internal_hbl'
            ],
            [
                'name' => 'Ryan Rinaldi',
                'no_hp' => '082181515652',
                'email' => 'internalhbl03@gmail.com',
                'password' => bcrypt('Hbl003'),
                'tipe_user' => 'internal_hbl'
            ],
            [
                'name' => 'Khoirun Na\'im',
                'no_hp' => '088215186360',
                'email' => 'internalhbl04@gmail.com',
                'password' => bcrypt('Hbl004'),
                'tipe_user' => 'internal_hbl'
            ],
            [
                'name' => 'Andri Rohimin',
                'no_hp' => '0881023482162',
                'email' => 'internalhbl05@gmail.com',
                'password' => bcrypt('Hbl005'),
                'tipe_user' => 'internal_hbl'
            ]
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // Cek pakai email
                $user
            );
        }
    }
}
