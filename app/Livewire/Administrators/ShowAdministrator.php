<?php

namespace App\Livewire\Administrators;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowAdministrator extends Component
{
    public string $name;

    public string $email;

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.administrators.show-administrator');
    }

    /**
     * Set the specified model instance for the component.
     */
    #[On('administrator-show')]
    public function setValue(User $user): void
    {
        $this->fill([
            'name' => $user->name,
            'email' => $user->maskedEmail,
        ]);
    }
}
