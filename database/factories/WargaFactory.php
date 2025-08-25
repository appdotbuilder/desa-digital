<?php

namespace Database\Factories;

use App\Models\Desa;
use App\Models\RT;
use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warga>
 */
class WargaFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['L', 'P']);
        
        return [
            'desa_id' => Desa::factory(),
            'rt_id' => RT::factory(),
            'nama' => $this->faker->name($gender === 'L' ? 'male' : 'female'),
            'nik' => $this->faker->numerify('################'), // 16 digits
            'alamat' => $this->faker->address(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->dateTimeBetween('-80 years', '-1 year'),
            'jenis_kelamin' => $gender,
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'pekerjaan' => $this->faker->randomElement([
                'Petani', 'Pedagang', 'PNS', 'Swasta', 'Wiraswasta', 
                'Pensiunan', 'Ibu Rumah Tangga', 'Pelajar', 'Mahasiswa'
            ]),
            'pendidikan' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3']),
            'status_perkawinan' => $this->faker->randomElement(['belum_kawin', 'kawin', 'cerai_hidup', 'cerai_mati']),
            'status_keluarga' => $this->faker->randomElement([
                'kepala_keluarga', 'istri', 'anak', 'menantu', 'cucu', 
                'orang_tua', 'mertua', 'keponakan', 'lainnya'
            ]),
            'no_kk' => $this->faker->numerify('################'), // 16 digits
            'telepon' => $this->faker->phoneNumber(),
            'email' => $this->faker->optional()->safeEmail(),
            'is_active' => $this->faker->boolean(95),
        ];
    }

    /**
     * Indicate that the citizen is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the citizen is male.
     */
    public function male(): static
    {
        return $this->state(fn (array $attributes) => [
            'jenis_kelamin' => 'L',
            'nama' => $this->faker->name('male'),
        ]);
    }

    /**
     * Indicate that the citizen is female.
     */
    public function female(): static
    {
        return $this->state(fn (array $attributes) => [
            'jenis_kelamin' => 'P',
            'nama' => $this->faker->name('female'),
        ]);
    }
}