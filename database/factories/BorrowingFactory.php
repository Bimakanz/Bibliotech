<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $borrowedAt = Carbon::instance(fake()->dateTimeBetween('-1 month', 'now'));
        $returnDate = (clone $borrowedAt)->addDays(fake()->numberBetween(3, 14));
        $status = fake()->randomElement(Borrowing::statuses());

        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'borrower_name' => fake()->name(),
            'quantity' => fake()->numberBetween(1, 3),
            'status' => $status,
            'borrowed_at' => $borrowedAt,
            'return_date' => $returnDate,
            'status_updated_at' => $status === Borrowing::STATUS_PROCESSING
                ? null
                : Carbon::instance(fake()->dateTimeBetween($borrowedAt, 'now')),
            'notes' => fake()->optional(0.3)->sentence(),
        ];
    }
}
