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
        $studentsWhoPaid = $this->model->whereHas('cashTransactions', function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('date_paid', [$startDate, $endDate]);
        })->get();

        $studentsWhoDidNotPay = $this->model->whereDoesntHave('cashTransactions', function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('date_paid', [$startDate, $endDate]);
        })->get();

        return collect([
            'studentsPaid' => $studentsWhoPaid,
            'studentsNotPaid' => $studentsWhoDidNotPay,
        ]);
    }
}
