<?php

namespace Database\Factories;

use App\Models\CashTransaction;
use Carbon\Carbon;
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
            'bill' => 10000,
            'amount' => 10000,
            'date' => Carbon::createFromDate(date('Y'), mt_rand(1, 12), mt_rand(1, 31)),
            'note' => mt_rand(0, 1) ? $this->faker->text(20) : ''
        ];
    }
}
