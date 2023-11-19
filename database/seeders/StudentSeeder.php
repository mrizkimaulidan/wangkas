<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'school_class_id' => 1,
            'school_major_id' => 1,
            'student_identification_number' => '998564728',
            'name' => 'Budi Raharjo',
            'email' => 'budi@mail.com',
            'phone_number' => '+6285744483758',
            'gender' => 1,
            'school_year_start' => now()->year,
            'school_year_end' => now()->year + 3,
        ]);
    }
}
