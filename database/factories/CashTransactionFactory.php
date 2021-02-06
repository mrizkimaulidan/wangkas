<?php

namespace Database\Factories;

use App\Models\CashTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class CashTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CashTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'student_id' => mt_rand(1, 15),
            'amount' => 10000,
            'is_paid' => mt_rand(0, 1) ? 1 : 0,
            'day' => mt_rand(1, 31),
            'month' => date('m'),
            'year' => date('Y'),
            'note' => mt_rand(0, 1) ? $this->faker->text(20) : ''
        ];
    }
}
