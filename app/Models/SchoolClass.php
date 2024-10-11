<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function scopeSearch(Builder $query, string $searchQuery)
    {
        return $query->when($searchQuery, function (Builder $query) use ($searchQuery) {
            return $query->where('name', 'like', "%{$searchQuery}%");
        });
    }
}
