<?php

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Beranda')] class extends Component
{
    /**
     * Get total count of student record
     */
    #[Computed]
    public function studentCount(): int
    {
        return Student::count();
    }

    /**
     * Get total count of school class record
     */
    #[Computed]
    public function schoolClassCount(): int
    {
        return SchoolClass::count();
    }

    /**
     * Get total count of school major record
     */
    #[Computed]
    public function schoolMajorCount(): int
    {
        return SchoolMajor::count();
    }

    /**
     * Get total count of user record
     */
    #[Computed]
    public function userCount(): int
    {
        return User::count();
    }
};
