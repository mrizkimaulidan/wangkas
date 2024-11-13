<?php

namespace App\Livewire;

use App\Models\CashTransaction;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use App\Repositories\CashTransactionRepository;
use App\Repositories\StudentRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Dashboard extends Component
{
    protected CashTransactionRepository $cashTransactionRepository;

    protected StudentRepository $studentRepository;

    public string $year;

    private $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

    /**
     * Boot the component.
     */
    public function boot(
        CashTransactionRepository $cashTransactionRepository,
        StudentRepository $studentRepository,
    ): void {
        $this->cashTransactionRepository = $cashTransactionRepository;
        $this->studentRepository = $studentRepository;
    }

    /**
     * Initialize the component's state.
     */
    public function mount(): void
    {
        $this->year = now()->year;

        $cashTransactionAmount = $this->cashTransactionRepository->getMonthlyAmounts($this->year);
        $cashTransactionCount = $this->cashTransactionRepository->getMonthlyCounts($this->year);

        $this->dispatch(
            'dashboard-chart-loaded',
            amount: $this->fillMissingMonthsCounts($cashTransactionAmount->pluck('amount', 'month')),
            count: $this->fillMissingMonthsCounts($cashTransactionCount->pluck('count', 'month'))
        );
    }

    /**
     * Update the dashboard chart with cash transaction data for the specified year.
     */
    public function updateChart(): void
    {
        $cashTransactionAmount = $this->cashTransactionRepository->getMonthlyAmounts($this->year);
        $cashTransactionCount = $this->cashTransactionRepository->getMonthlyCounts($this->year);

        $this->dispatch(
            'dashboard-chart-updated',
            amount: $this->fillMissingMonthsCounts($cashTransactionAmount->pluck('amount', 'month')),
            count: $this->fillMissingMonthsCounts($cashTransactionCount->pluck('count', 'month'))
        );
    }

    /**
     * Render the view.
     */
    public function render(): View
    {
        $studentWithMajors = SchoolMajor::select('name', 'abbreviation')->withCount('students')->get();
        $studentGenders = $this->studentRepository->countStudentGender();

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
                        $studentGenders['male'],
                        $studentGenders['female'],
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

    /**
     * Fill in missing counts for each month in the provided collection.
     */
    private function fillMissingMonthsCounts(Collection $collection): array
    {
        $statistics = [];

        for ($i = 1; $i <= 12; $i++) {
            // if key exists so there is a borrowing count on that month
            // if key does not exists there is no borrowing on that month so the count
            // should be 0
            $statistics[$this->months[$i - 1]] = isset($collection[$i]) ? $collection[$i] : 0;
        }

        return $statistics;
    }
}
