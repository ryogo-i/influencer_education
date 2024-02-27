<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DeliveryTime;
use App\Models\Curriculum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryTime>
 */
class DeliveryTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $curriculumIds = Curriculum::pluck('id')->toArray();
        $curriculumId = $this->faker->randomElement($curriculumIds);

        $deliveryFrom = $this->faker->dateTimeBetween($startDate = '2023-04-01', $endDate = '2024-02-28')->setTime(0, 0, 0);
        $deliveryTo = $this->faker->dateTimeBetween($startDate = $deliveryFrom, $interval = '+24 hours')->setTime(17, 0, 0);

        return [
            'curriculum_id' => $curriculumId,
            'delivery_from' => $deliveryFrom,
            'delivery_to' => $deliveryTo,
        ];
    }
}
