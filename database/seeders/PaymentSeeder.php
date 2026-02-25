<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncation
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Transaction::truncate();
        Subscription::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // Ensure we have some users
        if (User::count() < 5) {
            User::factory(10)->create();
        }

        $users = User::all();
        $startDate = \Carbon\Carbon::create(2026, 1, 8);
        $endDate = \Carbon\Carbon::create(2026, 3, 31);

        // Generate 100 transactions distributed across the period
        for ($i = 0; $i < 100; $i++) {
            $user = $users->random();
            $status = fake()->randomElement(['success', 'pending', 'failed', 'expire']);

            // Random date between start and end
            $days = $endDate->diffInDays($startDate);
            $date = (clone $startDate)->addDays(rand(0, $days))->addHours(rand(0, 23))->addMinutes(rand(0, 59));

            // Ensure we have balanced data for Jan, Feb, Mar specifically
            // Or just random is fine for 100 items over 3 months (~1 per day)

            $transaction = Transaction::factory()->create([
                'user_id' => $user->id,
                'status' => $status,
                'transaction_time' => $status === 'success' ? $date : null,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            if ($status === 'success') {
                Subscription::create([
                    'user_id' => $user->id,
                    'status' => 'active',
                    'starts_at' => $date,
                    'expires_at' => (clone $date)->addMonth(),
                    'payment_method' => $transaction->payment_type,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
