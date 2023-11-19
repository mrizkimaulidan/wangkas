<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schoolClasses = ['DKV', 'TJKT', 'PPLG'];

        foreach ($schoolClasses as $schoolClass) {
            for ($i = 1; $i <= 3; $i++) {
                SchoolClass::create([
                    'name' => "$schoolClass $i",
                ]);
            }
        }
    }
}
