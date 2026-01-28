<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashTransaction extends Model
{
    /** @use HasFactory<\Database\Factories\CashTransactionFactory> */
    use HasFactory;

    /**
     * Search columns using LIKE operator.
     */
    #[Scope]
    protected function search(Builder $query, string $search): void
    {
        $query->whereRelation('student', 'name', 'LIKE', "%$search%")
            ->orWhereRelation('createdBy', 'name', 'LIKE', "%$search%");
    }

    /**
     * Sort columns using order by operator.
     */
    #[Scope]
    protected function sort(Builder $query, string $type): void
    {
        match ($type) {
            'student_name_asc' => $query->orderBy(
                Student::select('name')
                    ->whereColumn('students.id', 'cash_transactions.student_id')
                    ->limit(1),
                'asc'
            ),
            'student_name_desc' => $query->orderBy(
                Student::select('name')
                    ->whereColumn('students.id', 'cash_transactions.student_id')
                    ->limit(1),
                'desc'
            ),
            'amount_asc' => $query->orderBy('amount', 'asc'),
            'amount_desc' => $query->orderBy('amount', 'desc'),
            'newest' => $query->orderBy('date_paid', 'desc'),
            'oldest' => $query->orderBy('date_paid', 'asc'),
            default => $query->orderBy('date_paid', 'desc'),
        };
    }

    /**
     * Get student relationship
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get created by user relationship
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
