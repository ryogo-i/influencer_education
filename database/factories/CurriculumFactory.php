<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Curriculum;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curriculum>
 */
class CurriculumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = $this->faker;

        return [
            'title' => $faker->name(),
            'thumbnail' => $faker->imageUrl($width = 640, $height = 480, $category = 'cats', $randomize = true, $word = null),
            'description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
            'video_url' => $faker->url(),
            'alway_delivery_flg' => $faker->numberBetween($min = 0, $max = 1),//1の場合は常時公開とする。
            'classes_id' => $faker->numberBetween($min = 1, $max = 12),
        ];
    }
}
