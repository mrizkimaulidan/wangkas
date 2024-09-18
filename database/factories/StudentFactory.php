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
        $fakeNumber = fn(int $int1, $int2) => fake()->numberBetween($int1, $int2);
        $schoolClassID = SchoolClass::inRandomOrder()->first()->id;
        $schoolMajorID = SchoolMajor::inRandomOrder()->first()->id;

        // will generate 9 digit number
        $identificationNumber = substr($currentYear, 2) . $fakeNumber(100, 200) . $fakeNumber(200, 400) . $fakeNumber(1, 9);

        return [
            'school_class_id' => $schoolClassID,
            'school_major_id' => $schoolMajorID,
            'identification_number' => $identificationNumber,
            'name' => fake()->name,
            'phone_number' => fake()->phoneNumber,
            'gender' => fake()->randomElement([1, 2]),
            'school_year_start' => $currentYear,
            'school_year_end' => $currentYear + 3,
        ];
    }
}
