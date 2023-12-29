<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_class_id', 'school_major_id', 'student_identification_number',
        'name', 'email', 'phone_number',
        'gender', 'school_year_start', 'school_year_end',
    ];

    /**
     * Get school class relationship data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    /**
     * Get school major relationship data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schoolMajor(): BelongsTo
    {
        return $this->belongsTo(SchoolMajor::class);
    }

    /**
     * Get cash transactions relationship data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cashTransactions(): HasMany
    {
        return $this->hasMany(CashTransaction::class);
    }

    /**
     * Get gender name.
     *
     * @return string
     */
    public function getGenderName(): string
    {
        return $this->gender === 1 ? 'Laki-laki' : 'Perempuan';
    }
}
