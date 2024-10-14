<?php

namespace Database\Factories;

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currentYear = now()->year;

        // Generate 9-digit identification number
        $identificationNumber = substr($currentYear, 2).
            fake()->numberBetween(100, 199).
            fake()->numberBetween(200, 399).
            fake()->numberBetween(1, 9);

        return [
            'school_class_id' => SchoolClass::inRandomOrder()->value('id'),
            'school_major_id' => SchoolMajor::inRandomOrder()->value('id'),
            'identification_number' => $identificationNumber,
            'name' => fake()->name,
            'phone_number' => fake()->unique()->phoneNumber,
            'gender' => fake()->randomElement([1, 2]), // 1 = male, 2 = female
            'school_year_start' => $currentYear,
            'school_year_end' => $currentYear + 3,
        ];
    }
}
