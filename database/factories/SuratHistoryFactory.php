<?php

namespace Database\Factories;

use App\Models\Surat;
use App\Models\SuratHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratHistory>
 */
class SuratHistoryFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['draft', 'rt_approved', 'rw_approved', 'admin_process', 'village_head_approved', 'completed', 'rejected'];
        $statusFrom = $this->faker->randomElement($statuses);
        $availableNext = array_slice($statuses, array_search($statusFrom, $statuses) + 1);
        $statusTo = $this->faker->randomElement($availableNext ?: ['completed']);
        
        return [
            'surat_id' => Surat::factory(),
            'status_from' => $statusFrom,
            'status_to' => $statusTo,
            'changed_by_id' => User::factory(),
            'catatan' => $this->faker->optional()->sentence(),
        ];
    }
}