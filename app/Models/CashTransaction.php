<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashTransaction extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function countHowManyCashTransaction(string $user_id, string $start_date, string $end_date)
    {
        $student = Student::where('id', $user_id)->pluck('id');
        $cash_transaction = CashTransaction::whereBetween('date', [$start_date, $end_date])->whereIn('student_id', $student)->count();

        return $cash_transaction;
    }
}
