<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['success', 'pending', 'failed', 'expire']);
        $time = $this->faker->dateTimeBetween('-6 months', 'now');

        return [
            'user_id' => User::factory(),
            'order_id' => 'SUB-' . Str::uuid(),
            'gross_amount' => 30000,
            'status' => $status,
            'payment_type' => $this->faker->randomElement(['credit_card', 'gopay', 'shopeepay', 'bca_va']),
            'transaction_time' => $status === 'success' ? $time : null,
            'created_at' => $time,
            'updated_at' => $time,
        ];
    }
}
