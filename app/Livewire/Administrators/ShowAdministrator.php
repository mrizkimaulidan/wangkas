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
     * Set the value based on the given ID.
     */
    #[On('administrator-show')]
    public function setValue(int $id): void
    {
        $user = User::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
    }
}
