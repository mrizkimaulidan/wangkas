<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolMajor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abbreviation'];

    /**
     * Get the students relationship.
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Scope a query to search for data across multiple columns.
     *
     * @param  Illuminate\Database\Eloquent\Builder  $query
     */
    public function scopeSearch(Builder $query, string $searchQuery): void
    {
        $query->where('name', 'like', "%{$searchQuery}%")
            ->orWhere('abbreviation', 'like', "%{$searchQuery}%");
    }
}
