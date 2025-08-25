<?php

namespace Database\Factories;

use App\Models\Berita;
use App\Models\Desa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['pending', 'approved', 'rejected']);
        $isPublished = $status === 'approved' && $this->faker->boolean(80);
        
        return [
            'desa_id' => Desa::factory(),
            'judul' => $this->faker->sentence(6),
            'konten' => $this->faker->paragraphs(3, true),
            'gambar' => $this->faker->optional()->imageUrl(640, 480, 'village'),
            'admin_input_id' => User::factory(),
            'status_approve' => $status,
            'approved_by_id' => $status !== 'pending' ? User::factory() : null,
            'approved_at' => $status !== 'pending' ? $this->faker->dateTimeThisMonth() : null,
            'rejection_reason' => $status === 'rejected' ? $this->faker->sentence() : null,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? $this->faker->dateTimeThisMonth() : null,
        ];
    }
}