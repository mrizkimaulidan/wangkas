<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Support\Collection as SupportCollection;

class StudentRepository
{
    public function __construct(
        private Student $model
    ) {}

    /**
     * Get the paid and unpaid status of students for the given cash transactions.
     *
     * @param  string  $endDate
     */
    public function getStudentPaymentStatus(string $startDate, $endDate): SupportCollection
    {
        $studentsWhoPaid = $this->model->with('schoolMajor', 'schoolClass')->whereHas('cashTransactions', function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('date_paid', [$startDate, $endDate]);
        })->get();

        $studentsWhoDidNotPay = $this->model->with('schoolMajor', 'schoolClass')->whereDoesntHave('cashTransactions', function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('date_paid', [$startDate, $endDate]);
        })->get();

        return collect([
            'studentsPaid' => $studentsWhoPaid,
            'studentsNotPaid' => $studentsWhoDidNotPay,
        ]);
    }

    /**
     * Counts male and female students.
     *
     * @return array Array with 'male' and 'female' counts.
     */
    public function countStudentGender(): array
    {
        $male = $this->model->select('gender')->where('gender', 1)->count();
        $female = $this->model->select('gender')->where('gender', 2)->count();

        return [
            'male' => $male,
            'female' => $female,
        ];
    }
}
