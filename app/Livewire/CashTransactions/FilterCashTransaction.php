<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Filter Transaksi Kas')]
class FilterCashTransaction extends Component
{
    use WithPagination;

    public $student_id;

    public $user_id;

    public $school_major_id;

    public $school_class_id;

    public $start_date;

    public $end_date;

    public function render()
    {
        $filteredResult = CashTransaction::query()
            ->with('student', 'createdBy')
            ->whereRelation('student', 'id', '=', $this->student_id)
            ->orWhereRelation('student.schoolMajor', 'id', '=', $this->school_major_id)
            ->orWhereRelation('student.schoolClass', 'id', '=', $this->school_class_id)
            ->orWhereRelation('createdBy', 'id', '=', $this->user_id)
            ->orWhereBetween('date_paid', [$this->start_date, $this->end_date])
            ->paginate(5);

        return view('livewire.cash-transactions.filter-cash-transaction', [
            'filteredResult' => $filteredResult,
            'students' => Student::orderBy('name')->get(),
            'users' => User::orderBy('name')->get(),
            'schoolMajors' => SchoolMajor::orderBy('name')->get(),
            'schoolClasses' => SchoolClass::orderBy('name')->get(),
        ]);
    }
}
