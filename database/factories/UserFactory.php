<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'email' => $this->faker->unique()->email(),
            'password' => Hash::make($this->faker->word()),
            'phone' => $this->faker->unique()->regexify('[0-9]{12}'),
            'address' => $this->faker->word(),
            'role' => rand(1, 2),
        ];
    }
}
