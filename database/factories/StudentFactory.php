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
        $schoolYearStart = now()->year;
        $schoolClassID = SchoolClass::inRandomOrder()->first()->id;
        $schoolMajorID = SchoolMajor::inRandomOrder()->first()->id;
        $identificationNumber = substr($schoolYearStart, -2). 61 .$schoolMajorID.fake()->unique()
            ->numberBetween(1000, 9999);

        return [
            'school_class_id' => $schoolClassID,
            'school_major_id' => $schoolMajorID,
            'student_identification_number' => $identificationNumber,
            'name' => fake()->name,
            'email' => fake()->unique()->email,
            'phone_number' => fake()->unique()->phoneNumber,
            'gender' => fake()->randomElement([1, 2]),
            'school_year_start' => $schoolYearStart,
            'school_year_end' => $schoolYearStart + 3,
        ];
    }
}
