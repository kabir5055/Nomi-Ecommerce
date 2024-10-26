<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $name = $this->faker->words(3, true); // Generate a random product name
        
        return [
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id, // Random category_id
            'subcategory_id' => \App\Models\SubCategory::inRandomOrder()->first()->id, // Random subcategory_id
            'brand_id' => \App\Models\Brand::inRandomOrder()->first()->id, // Random brand_id
            'unit_id' => \App\Models\Unit::inRandomOrder()->first()->id, // Random unit_id
            'color' => $this->faker->safeColorName(), // Random color
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']), // Random size
            'product_name' => $name, // Product name
            'product_code' => $this->faker->unique()->numerify('PROD-#####'), // Unique product code
            'product_slug' => Str::slug($name, '-'), // Generate slug from name
            'sale_price' => $this->faker->randomFloat(2, 10, 1000), // Random sale price
            'discount_type' => $this->faker->randomElement(['percentage', 'flat']), // Discount type
            'discount_price' => $this->faker->randomFloat(2, 0, 100), // Random discount price
            'quantity' => $this->faker->numberBetween(1, 100), // Random quantity
            'product_description' => $this->faker->paragraph, // Random description
            'product_image' => $this->faker->imageUrl(640, 480, 'technics'), // Random product image URL
            'product_gallery' => json_encode([
                $this->faker->imageUrl(640, 480, 'technics'),
                $this->faker->imageUrl(640, 480, 'nature'),
                $this->faker->imageUrl(640, 480, 'abstract')
            ]), // JSON-encoded array of image URLs
        ];
    }
}

