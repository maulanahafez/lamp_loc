<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category' => $this->getRandomReportCategory(),
            'desc' => fake()->paragraph(rand(3, 5)),
            'status' => $this->getRandomReportStatus(),
            'staff_notes' => fake()->paragraph(rand(1, 4)),
        ];
    }

    private function getRandomReportCategory()
    {
        $categories = ['Rusak', 'Mati', 'Kerusakan Tiang', 'Gangguan Listrik'];
        $randomCategory = $categories[array_rand($categories)];
        return $randomCategory;
    }

    private function getRandomReportStatus()
    {
        $statuses = ['Aktif', 'Rusak', 'Dalam Pemeliharaan', 'Mati'];
        $randomIndex = array_rand($statuses);
        return $statuses[$randomIndex];
    }
}
