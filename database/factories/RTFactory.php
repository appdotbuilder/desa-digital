<?php

namespace Database\Factories;

use App\Models\RT;
use App\Models\RW;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RT>
 */
class RTFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rw_id' => RW::factory(),
            'nomor_rt' => str_pad((string)$this->faker->numberBetween(1, 50), 2, '0', STR_PAD_LEFT),
            'nama_rt' => 'RT ' . str_pad((string)$this->faker->numberBetween(1, 50), 2, '0', STR_PAD_LEFT),
            'alamat' => $this->faker->address(),
        ];
    }
}