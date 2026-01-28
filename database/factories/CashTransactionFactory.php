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
        $student = Student::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        return [
            'student_id' => $student->id,
            'amount' => 10000,
            'date_paid' => fake()->dateTimeBetween('-10 years'),
            'transaction_note' => fake()->optional()->sentence(),
            'created_by' => $user->id,
        ];
    }
}
