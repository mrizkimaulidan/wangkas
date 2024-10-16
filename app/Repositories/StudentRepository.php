<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

class StudentRepository
{
    public function __construct(
        private Student $model
    ) {}

    /**
     * Get the paid and unpaid status of students for the given cash transactions.
     *
     * @param  \Illuminate\Database\Eloquent\Collection|Illuminate\Pagination\LengthAwarePaginator  $cashTransactions
     */
    public function getStudentPaymentStatus(Collection|LengthAwarePaginator $cashTransactions): SupportCollection
    {
        $students = $this->model->select(
            'id',
            'school_class_id',
            'school_major_id',
            'name',
            'identification_number',
            'phone_number',
            'gender'
        )
            ->with('schoolClass:id,name', 'schoolMajor:id,name,abbreviation')
            ->orderBy('identification_number')
            ->get();

        $studentIds = $cashTransactions->pluck('student_id');

        $studentsWhoPaid = $students->whereIn('id', $studentIds)->sortBy('name');
        $studentsWhoDidNotPay = $students->whereNotIn('id', $studentIds)->sortBy('name');

        return collect([
            'studentsPaid' => $studentsWhoPaid,
            'studentsNotPaid' => $studentsWhoDidNotPay,
        ]);
    }
}
