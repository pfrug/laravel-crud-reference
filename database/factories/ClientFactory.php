<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->catchPhrase(),
            'tax_id' => $this->faker->regexify('[A-Z0-9]{9}'),
            'foreign_tax_id' => $this->faker->optional()->regexify('[A-Z0-9]{9}'),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'postal_code' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'province' => $this->faker->state(),
            'phone_1' => $this->faker->phoneNumber(),
            'phone_2' => $this->faker->optional()->phoneNumber(),
            'accounting_code' => $this->faker->regexify('[A-Z0-9]{5}'),
            'billing_by_ref' => $this->faker->boolean(),
            'country_id' => 1, // sobrescribir en seeder
            'payment_term_id' => 1,
            'client_group_id' => 1,
            'sales_rep_id' => 1,
        ];
    }
}
