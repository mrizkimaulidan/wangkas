<?php

namespace App\Contracts;

interface StudentInterface
{
    public function countStudentGender(int $gender): Int;
}
