<?php

namespace Database\Seeders;

use App\Models\CashTransaction;
use Illuminate\Database\Seeder;

class CashTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CashTransaction::factory(20)->create();
    }
}
