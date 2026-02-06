<?php

use App\Models\CashTransaction;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Beranda')] class extends Component
{
    public string $year;

    /**
     * Initialize component with data
     */
    public function mount(): void
    {
        $this->year = now()->year;
    }

    /**
     * Get total count of student record
     */
    #[Computed]
    public function studentCount(): int
    {
        return Student::count();
    }

    /**
     * Get total count of school class record
     */
    #[Computed]
    public function schoolClassCount(): int
    {
        return SchoolClass::count();
    }

    /**
     * Get total count of school major record
     */
    #[Computed]
    public function schoolMajorCount(): int
    {
        return SchoolMajor::count();
    }

    /**
     * Get total count of user record
     */
    #[Computed]
    public function userCount(): int
    {
        return User::count();
    }

    /**
     * Calculate total students by gender
     */
    #[Computed]
    public function studentCountByGender(): array
    {
        return [
            'Laki-laki' => Student::whereGender(1)->count(),
            'Perempuan' => Student::whereGender(2)->count(),
        ];
    }

    /**
     * Calculate student distribution by school major
     */
    #[Computed]
    public function studentDistributionByMajor(): array
    {
        $schoolMajors = SchoolMajor::select(['id', 'name'])
            ->withCount('students')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(fn ($schoolMajor) => [$schoolMajor->name => $schoolMajor->students_count])
            ->toArray();

        return $schoolMajors;
    }

    /**
     * Calculate total transaction count grouped by student gender
     */
    #[Computed]
    public function transactionCountByGender(): array
    {
        $students = Student::whereIn('gender', [1, 2])
            ->withCount('cashTransactions')
            ->get();

        return [
            'Laki-laki' => (int) $students->where('gender', 1)->sum('cash_transactions_count'),
            'Perempuan' => (int) $students->where('gender', 2)->sum('cash_transactions_count'),
        ];
    }

    /**
     * Aggregates monthly transaction statistics.
     *
     * Processes cash transactions for a specific year, grouping by month
     * to calculate total amounts and transaction counts. Returns structured
     * data organized chronologically for reporting and analysis purposes.
     */
    #[Computed]
    public function monthlyTransactionSummary(): array
    {
        // Get all transactions for the current year
        $yearlyTransactions = CashTransaction::whereYear('date_paid', $this->year)->get();

        // Aggregate data by month
        $monthlyAggregates = $yearlyTransactions
            ->groupBy(
                function ($transaction) {
                    // format the month into number from 0 to 12
                    return now()->createFromDate($transaction->date_paid)->format('n');
                }
            )
            ->map(function ($transactionsInMonth, $monthNumber) {
                // format the month into string from January to December
                $monthName = now()->createFromDate($transactionsInMonth->first()->date_paid)->format('M');

                return [
                    'month_number' => (int) $monthNumber,
                    'month_name' => Str::lower($monthName),
                    'amount_sum' => $transactionsInMonth->sum('amount'),
                    'transaction_count' => $transactionsInMonth->count(),
                ];
            })
            ->sortBy('month_number')
            ->values();

        return [
            'monthly_amounts' => $monthlyAggregates->map(fn ($aggregate) => [
                'month' => $aggregate['month_name'],
                'month_number' => $aggregate['month_number'],
                'total' => $aggregate['amount_sum'],
            ]),
            'monthly_counts' => $monthlyAggregates->map(fn ($aggregate) => [
                'month' => $aggregate['month_name'],
                'month_number' => $aggregate['month_number'],
                'count' => $aggregate['transaction_count'],
            ]),
        ];
    }

    /**
     * Dispatch a Livewire event to update both bar and line charts
     * with fresh transaction data for the selected year.
     */
    public function updateChart(): void
    {
        $this->dispatch('chart-updated',
            monthly_amounts: $this->monthlyTransactionSummary['monthly_amounts'],
            monthly_counts: $this->monthlyTransactionSummary['monthly_counts']
        );
    }
};
