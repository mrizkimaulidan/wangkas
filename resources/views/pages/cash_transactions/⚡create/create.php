<?php

use App\Livewire\Forms\StoreCashTransactionForm;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Tambah Data Kas')] class extends Component
{
    use WithPagination;

    public StoreCashTransactionForm $form;

    /**
     * Number of items per page
     * Persisted in URL
     */
    #[Url]
    public int $perPage = 5;

    /**
     * Search query for filtering
     * Persisted in URL
     */
    #[Url]
    public string $search = '';

    public string $start_date;

    public string $end_date;

    public ?string $school_major_id = '';

    public ?string $school_class_id = '';

    public Collection $students;

    public Collection $schoolClasses;

    public Collection $schoolMajors;

    /**
     * Initialize component with data
     */
    public function mount(): void
    {
        $this->form->date_paid = now()->toDateString();

        // TODO: should be dynamic from logged in user ID
        $this->form->created_by = User::inRandomOrder()->first()->id;

        $this->start_date = now()->startOfWeek()->format('Y-m-d');
        $this->end_date = now()->endOfWeek()->format('Y-m-d');

        $this->students = Student::orderBy('name')->get();
        $this->schoolClasses = SchoolClass::orderBy('name')->get();
        $this->schoolMajors = SchoolMajor::orderBy('name')->get();
    }

    /**
     * Process form submission for creating data
     */
    public function save(): void
    {
        $this->form->store();

        session()->flash('success', 'Data kas berhasil ditambahkan!');

        $this->redirectRoute('kas.index', navigate: true);
    }

    /**
     * Get paginated list of unpaid students
     */
    #[Computed]
    public function unpaidStudents(): LengthAwarePaginator
    {
        return Student::query()
            ->with(['schoolMajor', 'schoolClass'])
            ->whereDoesntHave('cashTransactions', function (Builder $q) {
                $q->whereBetween('date_paid', [$this->start_date, $this->end_date]);
            })
            ->when($this->search, function (Builder $q) {
                $q->search($this->search);
            })
            ->when($this->school_major_id, function (Builder $q) {
                $q->where('school_major_id', $this->school_major_id);
            })
            ->when($this->school_class_id, function (Builder $q) {
                $q->where('school_class_id', $this->school_class_id);
            })
            ->orderBy('name')
            ->paginate($this->perPage, pageName: 'filter-page');
    }
};
