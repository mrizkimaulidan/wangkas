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
        CashTransaction::factory()->count(200)->create();
    }
}
