<?php

namespace Database\Factories;

use App\Models\Desa;
use App\Models\Galeri;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Galeri>
 */
class GaleriFactory extends Factory
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
            'judul' => $this->faker->sentence(4),
            'deskripsi' => $this->faker->optional()->paragraph(),
            'kategori' => $this->faker->randomElement(['kegiatan', 'fasilitas', 'pembangunan', 'lainnya']),
            'file' => $this->faker->imageUrl(800, 600, 'village'),
            'file_type' => 'image/jpeg',
            'file_size' => $this->faker->numberBetween(100000, 5000000),
            'uploaded_by_id' => User::factory(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}