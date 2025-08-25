<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Desa>
 */
class DesaFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => 'Desa ' . $this->faker->city(),
            'alamat' => $this->faker->address(),
            'kode_pos' => $this->faker->postcode(),
            'telepon' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'paket_langganan' => $this->faker->randomElement(['basic', 'premium', 'enterprise']),
            'max_users' => $this->faker->numberBetween(50, 500),
            'max_letters' => $this->faker->numberBetween(1000, 10000),
            'max_storage' => $this->faker->numberBetween(1073741824, 10737418240), // 1GB to 10GB
            'is_active' => $this->faker->boolean(90),
            'subscription_expires_at' => $this->faker->dateTimeBetween('now', '+2 years'),
        ];
    }

    /**
     * Indicate that the village is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the village is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}