<?php

namespace App\Livewire;

use App\Models\CashTransaction;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $studentWithMajors = SchoolMajor::select('name', 'abbreviation')->withCount('students')->get();
        $cashTransactionAmountPerYear = CashTransaction::selectRaw('EXTRACT(YEAR FROM date_paid) AS year, SUM(amount) AS amount')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $cashTransactionCountPerYear = CashTransaction::selectRaw('EXTRACT(YEAR FROM date_paid) AS year, COUNT(*) AS count')
            ->groupBy('year')
            ->get();

        $cashTransactionCountByGender = CashTransaction::leftJoin('students', 'cash_transactions.student_id', '=', 'students.id')
            ->selectRaw('students.gender AS gender, COUNT(*) AS total_paid')
            ->groupBy('gender')
            ->get();

        $charts = [
            'counter' => [
                'student' => Student::count(),
                'schoolClass' => SchoolClass::count(),
                'schoolMajor' => SchoolMajor::count(),
                'administrator' => User::count(),
            ],
            'pieChart' => [
                'studentGender' => [
                    'series' => [
                        Student::select('gender')->where('gender', 1)->count(),
                        Student::select('gender')->where('gender', 2)->count(),
                    ],
                    'labels' => ['Laki-laki', 'Perempuan'],
                ],
                'studentMajor' => [
                    'series' => $studentWithMajors->pluck('students_count'),
                    'labels' => $studentWithMajors->map(function ($studentMajor) {
                        return "$studentMajor->name ($studentMajor->abbreviation)";
                    }),
                ],
                'cashTransactionCountByGender' => [
                    'series' => $cashTransactionCountByGender->pluck('total_paid'),
                    'labels' => ['Laki-laki', 'Perempuan'],
                ],
            ],
            'lineChart' => [
                'cashTransactionAmountPerYear' => [
                    'series' => $cashTransactionAmountPerYear->pluck('amount'),
                    'categories' => $cashTransactionAmountPerYear->pluck('year'),
                ],
                'cashTransactionCountPerYear' => [
                    'series' => $cashTransactionCountPerYear->pluck('count'),
                    'categories' => $cashTransactionCountPerYear->pluck('year'),
                ],
            ],
        ];

        return view('livewire.dashboard', [
            'charts' => $charts,
        ]);
    }
}
