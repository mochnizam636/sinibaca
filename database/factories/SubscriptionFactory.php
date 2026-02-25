<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = $this->faker->dateTimeBetween('-6 months', 'now');
        $expiresAt = (clone $startsAt)->modify('+1 month');
        $isActive = $expiresAt > now();

        return [
            'user_id' => User::factory(),
            'status' => $isActive ? 'active' : 'expired',
            'starts_at' => $startsAt,
            'expires_at' => $expiresAt,
            'payment_method' => 'midtrans',
            'created_at' => $startsAt,
            'updated_at' => $startsAt,
        ];
    }
}
