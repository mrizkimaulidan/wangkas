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
        return [
            'school_class_id' => mt_rand(1, 12),
            'school_major_id' => mt_rand(1, 3),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'phone_number' => $this->faker->unique()->phoneNumber,
            'gender' => 1 ?? 2,
            'school_year' => mt_rand(2010, date('Y') - 4)
        ];
    }
}
