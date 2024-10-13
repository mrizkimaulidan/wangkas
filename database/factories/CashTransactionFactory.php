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
        return [
            'student_id' => Student::inRandomOrder()->value('id'),
            'amount' => round(fake()->numberBetween(100000, 250000), -3),
            'date_paid' => fake()->dateTimeBetween('-10 years'),
            'transaction_note' => fake()->optional()->word,
            'created_by' => User::inRandomOrder()->value('id'),
        ];
    }
}
