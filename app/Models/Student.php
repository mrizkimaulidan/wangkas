<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    public function school_classes(): Object
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id', 'id');
    }

    public function school_majors(): Object
    {
        return $this->belongsTo(SchoolMajor::class, 'school_major_id', 'id');
    }
}
