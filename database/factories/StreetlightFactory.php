<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Streetlight>
 */
class StreetlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'order' => fake()->numberBetween(0,10),
            'name' => strtoupper(fake()->bothify('??##')),
            'lat' => fake()->latitude(-7.456175, -7.437622),
            'long' => fake()->longitude(109.267090, 109.320992),
            'type' => $this->getRandomStreetlightType(),
            'status' => $this->getRandomStreetlightStatus(),
            'model' => $this->getRandomStreetlightModel(),
            'height' => fake()->randomFloat(2, 3, 10),
            'power_rate' => fake()->numberBetween(20, 400),
            'voltage_rate' => $this->generateRandomVoltageRate(),
            'illumination_level' => fake()->numberBetween(10, 500),
            'manufacturer' => fake()->company(),
        ];
    }

    private function getRandomStreetlightType()
    {
        $types = ['LED', 'Tungsten', 'Fluorescent', 'Halogen', 'Sodium Vapor'];
        $randomIndex = array_rand($types);
        return $types[$randomIndex];
    }

    private function getRandomStreetlightStatus()
    {
        $statuses = ['Aktif', 'Rusak', 'Dalam Pemeliharaan', 'Mati'];
        $randomIndex = array_rand($statuses);
        return $statuses[$randomIndex];
    }

    private function getRandomStreetlightModel()
    {
        $models = ['Classic', 'Solar-Powered', 'Modern LED', 'Decorative', 'High-Pole', 'Traditional Lamp Post', 'Smart', 'Industrial High-Bay', 'Vintage Lantern', 'Minimalist'];
        $randomIndex = array_rand($models);
        return $models[$randomIndex];
    }

    private function generateRandomVoltageRate()
    {
        $voltage = fake()->numberBetween(110, 240);
        $type = (fake()->boolean) ? 'AC' : 'DC';
        return "$voltage/$type";
    }
}
