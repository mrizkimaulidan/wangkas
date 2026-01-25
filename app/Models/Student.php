<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        $query->when($type === 'identification_number_asc', function (Builder $q) {
            $q->orderBy('identification_number', 'asc');
        })->when($type === 'identification_number_desc', function (Builder $q) {
            $q->orderBy('identification_number', 'desc');
        })->when($type === 'name_asc', function (Builder $q) {
            $q->orderBy('name', 'asc');
        })->when($type === 'name_desc', function (Builder $q) {
            $q->orderBy('name', 'desc');
        });
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
}
