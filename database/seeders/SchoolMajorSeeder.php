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
        $schoolMajors = [
            ['name' => 'Desain Komunikasi Visual', 'abbreviation' => 'DKV'],
            ['name' => 'Teknik Jaringan Komputer dan Telekomunikasi', 'abbreviation' => 'TJKT'],
            ['name' => 'Pengembangan Perangkat Lunak dan Gim', 'abbreviation' => 'PPLG'],
        ];

        foreach ($schoolMajors as $schoolMajor) {
            SchoolMajor::create($schoolMajor);
        }
    }
}
