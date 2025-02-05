<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'vat' => fake()->countryCode() . fake()->randomNumber(8, true),
            'email' => fake()->companyEmail(),
            'phone' => fake()->e164PhoneNumber(),
            'iban' => fake()->iban(),
            'bank' => fake()->company(),
        ];
    }
}
