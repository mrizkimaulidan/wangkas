<?php

namespace Database\Seeders;

use App\Models\CashTransaction;
use Illuminate\Database\Seeder;

class CashTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = now()->year;
        for ($i = 0; $i < 500; $i++) {
            CashTransaction::create([
                'student_id' => 1,
                'amount' => 10000,
                'date_paid' => now()->createFromDate(mt_rand($year - 5, $year), mt_rand(1, 12), mt_rand(1, 31)),
                'created_by' => 1,
            ]);
        }
    }
}
