<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\Student;

class StudentRepository extends Controller
{
    public function __construct(
        private Student $model
    ) {
    }

    /**
     * Menghitung jenis kelamin pelajar berdasarkan value angka di parameter.
     * Angka 1 untuk laki-laki.
     * Angka 2 untuk perempuan.
     *
     * @param int $gender
     * @return Int
     */
    public function countStudentGender(int $gender): Int
    {
        return $this->model->whereGender($gender)->count();
    }
}
