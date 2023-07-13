<?php

namespace Database\Factories;

use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stock' => rand(10,50),
            'description' => $this->faker->text(250),
            'name' => $this->faker->word(),
            'price' => round(rand(1000,200000),-3),
            'image_path' => 'images/'.$this->faker->randomElement(['flower1.jpg','white.jpg','bonquet1.jpg','bouquet2.jpg','pinky.jpg']),
        ];
    }
}
