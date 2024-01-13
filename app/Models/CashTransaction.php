<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'amount', 'date_paid', 'transaction_note', 'created_by'];

    /**
     * Get student relationship data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the user relationship who created the data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Format a numeric amount as a localized currency string.
     *
     * @param float $num
     * @return string
     */
    public static function localizationAmountFormat(float $num): string
    {
        return 'Rp' . number_format($num, 0, ',', '.');
    }

    /**
     * Get the formatted date_paid attribute in 'd-m-Y' format.
     *
     * @return string
     */
    public function getDatePaidFormattedAttribute(): string
    {
        return now()->parse($this->date_paid)->format('d-m-Y');
    }

    /**
     * Get the formatted amount attribute using localizationAmountFormat.
     *
     * @return string
     */
    public function getAmountFormattedAttribute(): string
    {
        return $this->localizationAmountFormat($this->amount);
    }
}
