<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KaryawanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nik' => $this->faker->unique()->numerify('##############'),
            'jabatan' => $this->faker->randomElement(['Karyawan', 'Manager', 'HRD', 'Staff']),
            'alamat' => $this->faker->address(),
            'telepon' => $this->faker->phoneNumber(),
        ];
    }
}
