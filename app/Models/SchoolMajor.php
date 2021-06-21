<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolMajor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'abbreviated_word'];

    public function students(): Object
    {
        return $this->hasMany(Student::class);
    }
}
