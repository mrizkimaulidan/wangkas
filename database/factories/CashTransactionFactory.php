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
        $studentID = Student::inRandomOrder()->first()->id;
        $userID = User::inRandomOrder()->first()->id;
        $now = now();

        $fakeElement = fn($element1, $element2) => fake()->randomElement([$element1, $element2]);

        return [
            'student_id' => $studentID,
            'amount' => round(fake()->numberBetween(100000, 250000), -3),
            'date_paid' => $now->createFromDate($now->year - fake()->numberBetween(1, 3), $fakeElement(1, 12), $fakeElement(1, 31)),
            'transaction_note' => $fakeElement(null, fake()->word),
            'created_by' => $userID
        ];
    }
}
