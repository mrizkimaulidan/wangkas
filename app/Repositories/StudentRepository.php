<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    public function __construct(
        private Student $model
    ) {
    }

    public function countStudentGender()
    {
        $students = $this->model->select('gender')->get();

        $counts = $students->countBy(function ($student) {
            return $student->gender == 1 ? 'male' : 'female';
        })->all();

        $counts += ['male' => 0, 'female' => 0];

        return $counts;
    }
}
