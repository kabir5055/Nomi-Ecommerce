<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Color;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Color>
 */
class ColorFactory extends Factory
{
   
   protected $model = Color::class;

    public function definition()
    {
        // return [
        //     'color_name' => $this->faker->colorName,
        //     'color_slug' => $this->faker->colorName,
        // ];

        // return [
        //     'color_name' => $this->faker->colorName,
        //     'color_slug' => $this->faker->unique()->slug,
        // ];

         $colorName = $this->faker->colorName;

        return [
            'color_name' => $colorName,
            'color_slug' => Str::slug($colorName), // Generate slug from color_name
        ];

    }

}
