<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolMajor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abbreviation'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
