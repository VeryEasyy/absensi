<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nuptk' => $this->faker->unique()->numerify('##########'), // Simulated NUPTK (unique string)
            'nama' => $this->faker->name, // Random name
            'jabatan' => $this->faker->word, // Random jabatan (position)
            'no_hp' => $this->faker->phoneNumber, // Random phone number
            'foto' =>null,// Optional: random image URL for the photo field
            'password' => Hash::make('password123'), // Default password for testing
        ];
    }
}
