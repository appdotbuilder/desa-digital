<?php

namespace Database\Factories;

use App\Models\Desa;
use App\Models\RW;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RW>
 */
class RWFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'desa_id' => Desa::factory(),
            'nomor_rw' => str_pad((string)$this->faker->numberBetween(1, 20), 2, '0', STR_PAD_LEFT),
            'nama_rw' => 'Dusun ' . $this->faker->firstName(),
            'alamat' => $this->faker->address(),
        ];
    }
}