<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentIDs = Student::pluck('id')->toArray();
        $userIDs = User::pluck('id')->toArray();

        $data = [];
        $totalRecords = 100000;
        $chunkSize = min(1000, $totalRecords);

        $this->command->getOutput()->progressStart($totalRecords);

        for ($i = 0; $i < $totalRecords; $i++) {
            $data[] = [
                'student_id' => fake()->randomElement($studentIDs),
                'amount' => fake()->numberBetween(50000, 100000),
                'date_paid' => fake()->dateTimeBetween('-10 years'),
                'transaction_note' => fake()->optional()->sentence,
                'created_by' => fake()->randomElement($userIDs),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($data) >= $chunkSize) {
                DB::table('cash_transactions')->insert($data);
                $data = [];

                $this->command->getOutput()->progressAdvance($chunkSize);
            }
        }

        if (! empty($data)) {
            DB::table('cash_transactions')->insert($data);
            $this->command->getOutput()->progressAdvance(count($data));
        }

        $this->command->getOutput()->progressFinish();
        $this->command->info("✅ Successfully inserted {$totalRecords} cash transactions.");
    }
}
