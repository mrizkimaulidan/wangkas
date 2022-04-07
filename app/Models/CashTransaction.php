<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['student_id', 'bill', 'amount', 'is_paid', 'date', 'note'];

    protected $casts = [
        'is_paid' => 'integer',
    ];

    /**
     * Get students relation data.
     *
     * @return BelongsTo
     */
    public function students(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Get users relation data.
     *
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Set date attribute when storing data.
     *
     * @param string $value
     * @return void
     */
    public function setDateAttribute(string $value): void
    {
        $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }
}
