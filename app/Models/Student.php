<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = [
        'school_major_id', 'school_class_id', 'identification_number', 'name',
        'phone_number', 'gender', 'school_year_start', 'school_year_end',
    ];

    /**
     * Search columns using LIKE operator.
     */
    #[Scope]
    protected function search(Builder $query, string $search): void
    {
        $query->where('identification_number', 'LIKE', "%$search%")
            ->orWhere('name', 'LIKE', "%$search%")
            ->orWhere('phone_number', 'LIKE', "%$search%");
    }

    /**
     * Sort columns usign order by operator.
     */
    #[Scope]
    protected function sort(Builder $query, string $type): void
    {
        match ($type) {
            'identification_number_asc' => $query->orderBy('identification_number', 'asc'),
            'identification_number_desc' => $query->orderBy('identification_number', 'desc'),
            'name_asc' => $query->orderBy('name', 'asc'),
            'name_desc' => $query->orderBy('name', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('created_at', 'desc'),
        };
    }

    #[Scope]
    protected function filterBySchoolMajor(Builder $query, string $value): void
    {
        $query->where('school_major_id', $value);
    }

    #[Scope]
    protected function filterBySchoolClass(Builder $query, string $value): void
    {
        $query->where('school_class_id', $value);
    }

    #[Scope]
    protected function filterByGender(Builder $query, string $value): void
    {
        $query->where('gender', $value);
    }

    /**
     * Get school major relationship
     */
    public function schoolMajor(): BelongsTo
    {
        return $this->belongsTo(SchoolMajor::class);
    }

    /**
     * Get school class relationship
     */
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    /**
     * Get cash transactions relationship
     */
    public function cashTransactions(): HasMany
    {
        return $this->hasMany(CashTransaction::class);
    }
}
