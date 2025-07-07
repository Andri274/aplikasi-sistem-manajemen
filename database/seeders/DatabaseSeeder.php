<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);
    }
}
