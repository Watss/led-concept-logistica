<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'rut' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'type' => $this->faker->randomElement(["persona","empresa"]),
            'address' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'draft' => $this->faker->regexify('[A-Za-z0-9]{255}'),
        ];
    }
}
