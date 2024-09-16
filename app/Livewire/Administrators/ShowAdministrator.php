<?php

namespace App\Livewire\Administrators;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowAdministrator extends Component
{
    public string $name, $email;

    public function render()
    {
        return view('livewire.administrators.show-administrator');
    }

    #[On('administrator-show')]
    public function setValue(string $id)
    {
        $user = User::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
    }
}
