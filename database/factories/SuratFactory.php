<?php

namespace Database\Factories;

use App\Models\Desa;
use App\Models\RT;
use App\Models\RW;
use App\Models\Surat;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surat>
 */
class SuratFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['draft', 'rt_approved', 'rw_approved', 'admin_process', 'village_head_approved', 'completed']);
        
        return [
            'desa_id' => Desa::factory(),
            'warga_id' => Warga::factory(),
            'rt_id' => RT::factory(),
            'rw_id' => RW::factory(),
            'created_by_id' => User::factory(),
            'nomor_surat' => $status === 'completed' ? $this->faker->numerify('###/###/####') : null,
            'jenis_surat' => $this->faker->randomElement([
                'Surat Keterangan Domisili',
                'Surat Keterangan Tidak Mampu',
                'Surat Pengantar KTP',
                'Surat Pengantar Nikah',
                'Surat Keterangan Usaha',
                'Surat Keterangan Kelahiran'
            ]),
            'keperluan' => $this->faker->sentence(10),
            'keterangan' => $this->faker->optional()->paragraph(),
            'input_type' => $this->faker->randomElement(['online', 'manual']),
            'status' => $status,
            'submitted_at' => $status !== 'draft' ? $this->faker->dateTimeThisMonth() : null,
            'completed_at' => $status === 'completed' ? $this->faker->dateTimeThisMonth() : null,
        ];
    }
}