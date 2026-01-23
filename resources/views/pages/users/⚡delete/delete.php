<?php

use App\Models\User;
use Livewire\Component;

new class extends Component
{
    public User $user;

    /**
     * Initialize component with data
     */
    public function mount(User $user): void
    {
        $this->user = $user;
    }

    /**
     * Process data deletion
     */
    public function destroy(): void
    {
        $this->user->delete();
        $this->redirect('/pengguna', navigate: true);
    }
};
