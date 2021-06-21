<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_class_id', 'school_major_id', 'student_identification_number',
        'name', 'email', 'phone_number', 'gender', 'school_year_start',
        'school_year_end'
    ];

    public function school_classes(): Object
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id', 'id');
    }

    public function school_majors(): Object
    {
        return $this->belongsTo(SchoolMajor::class, 'school_major_id', 'id');
    }
}
