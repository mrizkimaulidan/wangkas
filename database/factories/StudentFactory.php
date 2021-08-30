<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $school_year = date('Y');

        return [
            'school_class_id' => mt_rand(1, 12),
            'school_major_id' => mt_rand(1, 3),
            'student_identification_number' => '00' . $this->faker->randomNumber(8),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'phone_number' => '08' . mt_rand(100, 200) . mt_rand(300, 600) . mt_rand(1000, 9999),
            'gender' => mt_rand(1, 2),
            'school_year_start' => $school_year - 3,
            'school_year_end' => $school_year
        ];
    }
}
