<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolClass extends Model
{
    /** @use HasFactory<\Database\Factories\SchoolClassFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    /**
     * Search columns using LIKE operator.
     */
    #[Scope]
    protected function search(Builder $query, string $search): void
    {
        $query->where('name', 'LIKE', "%$search%");
    }

    /**
     * Sort columns usign order by operator.
     */
    #[Scope]
    protected function sort(Builder $query, string $type): void
    {
        match ($type) {
            'name_asc' => $query->orderBy('name', 'asc'),
            'name_desc' => $query->orderBy('name', 'desc'),
            'students_count_asc' => $query->orderBy('students_count', 'asc'),
            'students_count_desc' => $query->orderBy('students_count', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('created_at', 'desc'),
        };
    }

    /**
     * Get students relationship
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
