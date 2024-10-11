<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_class_id',
        'school_major_id',
        'identification_number',
        'name',
        'phone_number',
        'gender',
        'school_year_start',
        'school_year_end',
    ];

    /**
     * Get the school class relationship.
     */
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    /**
     * Get the school major relationship.
     */
    public function schoolMajor(): BelongsTo
    {
        return $this->belongsTo(SchoolMajor::class);
    }

    /**
     * Get the cash transactions relationship.
     */
    public function cashTransactions(): HasMany
    {
        return $this->hasMany(CashTransaction::class);
    }

    public function scopeSearch(Builder $query, $searchQuery)
    {
        return $query->when($searchQuery, function (Builder $query) use ($searchQuery) {
            return $query->where('identification_number', 'like', "%{$searchQuery}%")
                ->orWhereHas('schoolClass', function (Builder $schoolClassQuery) use ($searchQuery) {
                    return $schoolClassQuery->where('name', 'like', "%{$searchQuery}%");
                })
                ->orWhereHas('schoolMajor', function (Builder $schoolMajorQuery) use ($searchQuery) {
                    return $schoolMajorQuery->where('name', 'like', "%{$searchQuery}%");
                })
                ->orWhere('name', 'like', "%{$searchQuery}%")
                ->orWhere('school_year_start', 'like', "%{$searchQuery}%")
                ->orWhere('school_year_end', 'like', "%{$searchQuery}%");
        });
    }
}
