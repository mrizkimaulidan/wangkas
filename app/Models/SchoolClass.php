<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Scope a query to search for data across multiple columns.
     */
    public function scopeSearch(Builder $query, string $searchQuery): void
    {
        $query->where('name', 'like', "%{$searchQuery}%");
    }
}
