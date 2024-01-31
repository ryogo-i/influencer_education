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
        $curriculumIds = Curriculum::pluck('id')->toArray(); // Curriculums テーブルの全ての ID を配列として取得
        $curriculumId = $this->faker->randomElement($curriculumIds); // 配列からランダムに1つの ID を選択

        $deliveryFrom = $this->faker->dateTimeBetween($startDate = '2023-04-01', $endDate = '2024-02-28');
        $deliveryTo = $this->faker->dateTimeBetween($startDate = $deliveryFrom, $endDate = '2024-03-31');

        return [
            'curriculum_id' => $curriculumId,
            'delivery_from' => $deliveryFrom,
            'delivery_to' => $deliveryTo,
        ];
    }
}
