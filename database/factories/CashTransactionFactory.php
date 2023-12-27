<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CashTransaction>
 */
class CashTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $datePaid = now()->createFromDate(rand(2010, now()->year), rand(1, 12), rand(1, 31))->format('Y-m-d');

        return [
            'student_id' => Student::inRandomOrder()->first()->id,
            'amount' => round(fake()->numberBetween(50000, 100000), -3),
            'date_paid' => $datePaid,
            'transaction_note' => fake()->randomElement([null, fake()->sentence]),
            'created_by' => User::inRandomOrder()->first()->id,
        ];
    }
}
