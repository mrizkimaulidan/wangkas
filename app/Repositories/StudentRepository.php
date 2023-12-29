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
        $counts = [
            'male' => $this->model->select('gender')->where('gender', 1)->count(),
            'female' => $this->model->select('gender')->where('gender', 2)->count(),
        ];

        return $counts;
    }
}
