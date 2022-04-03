<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'school_class_id', 'school_major_id', 'student_identification_number',
        'name', 'email', 'phone_number', 'gender', 'school_year_start',
        'school_year_end'
    ];

    /**
     * Get school class relation data.
     *
     * @return BelongsTo
     */
    public function school_class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    /**
     * Get school major relation data.
     *
     * @return BelongsTo
     */
    public function school_major(): BelongsTo
    {
        return $this->belongsTo(SchoolMajor::class);
    }

    /**
     * Get cash transaction relation data.
     *
     * @return HasMany
     */
    public function cash_transactions(): HasMany
    {
        return $this->hasMany(CashTransaction::class);
    }

    /**
     * Get student gender name.
     *
     * @return string
     */
    public function getGenderName(): string
    {
        return match ($this->gender) {
            1 => 'Laki-laki',
            2 => 'Perempuan'
        };
    }
}
