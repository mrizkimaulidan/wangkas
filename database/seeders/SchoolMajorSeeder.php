<?php

namespace Database\Seeders;

use App\Models\SchoolMajor;
use Illuminate\Database\Seeder;

class SchoolMajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolMajor::factory()->count(3)->create();
    }
}
