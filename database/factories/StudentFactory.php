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
        $schoolClass = SchoolClass::inRandomOrder()->first();
        $schoolMajor = SchoolMajor::inRandomOrder()->first();

        $identificationNumber = substr($currentYear, -2).mt_rand(100, 200).mt_rand(100, 200);

        return [
            'school_major_id' => $schoolClass->id,
            'school_class_id' => $schoolMajor->id,
            'identification_number' => $identificationNumber,
            'name' => fake()->name,
            'phone_number' => fake()->phoneNumber(),
            'gender' => fake()->numberBetween(1, 2),
            'school_year_start' => $currentYear,
            'school_year_end' => $currentYear + 3,
        ];
    }
}
