<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Search columns using LIKE operator.
     */
    #[Scope]
    protected function search(Builder $query, string $search): void
    {
        $query->where('name', 'LIKE', "%$search%");
    }

    /**
     * Sort columns using order by operator.
     */
    #[Scope]
    protected function sort(Builder $query, string $type): void
    {
        $query->when($type === 'name_asc', function (Builder $q) {
            $q->orderBy('name', 'asc');
        })->when($type === 'name_desc', function (Builder $q) {
            $q->orderBy('name', 'desc');
        })->when($type === 'newest', function (Builder $q) {
            $q->orderBy('created_at', 'desc');
        })->when($type === 'oldest', function (Builder $q) {
            $q->orderBy('created_at', 'asc');
        });
    }
}
