<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    public function students(): Object
    {
        return $this->hasMany(Student::class);
    }
}
