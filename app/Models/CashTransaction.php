<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'bill', 'amount', 'is_paid', 'date', 'note'];

    protected $casts = [
        'is_paid' => 'integer',
    ];

    public function students(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setDateAttribute(string $value): void
    {
        $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }
}
