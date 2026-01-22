<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        $query->when($type === 'name_asc', function (Builder $q) {
            $q->orderBy('name', 'asc');
        })->when($type === 'name_desc', function (Builder $q) {
            $q->orderBy('name', 'desc');
        });
    }
}
