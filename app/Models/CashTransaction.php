<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'amount', 'date_paid', 'transaction_note', 'created_by'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function scopeSearch(Builder $query, string $searchQuery)
    {
        return $query->when($searchQuery, function (Builder $query) use ($searchQuery) {
            return $query->where(function (Builder $query) use ($searchQuery) {
                $query->where('amount', 'like', "%{$searchQuery}%")
                    ->orWhereHas('student', function (Builder $studentQuery) use ($searchQuery) {
                        return $studentQuery->where('name', 'like', "%{$searchQuery}%");
                    })
                    ->orWhereHas('createdBy', function (Builder $userQuery) use ($searchQuery) {
                        return $userQuery->where('name', 'like', "%{$searchQuery}%");
                    });
            });
        });
    }
}
