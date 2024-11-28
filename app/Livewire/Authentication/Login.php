<?php

namespace App\Livewire\Authentication;

use App\Livewire\Dashboard;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.authentication.app')]
class Login extends Component
{
    #[Validate('required', message: 'Alamat email tidak boleh kosong!')]
    #[Validate('email', message: 'Alamat email bukan email yang valid!')]
    public string $email = '';

    #[Validate('required', message: 'Kata sandi tidak boleh kosong!')]
    public string $password = '';

    public bool $remember_me = false;

    public string $input_type = 'password';

    public string $icon = 'bi bi-eye-fill';

    public string $input_title = 'Tampilkan kata sandi';

    /**
     * Toggle password visibility by switching the input type and icon.
     */
    public function togglePasswordVisibility(): void
    {
        $this->input_type = $this->input_type === 'text' ? 'password' : 'text';
        $this->icon = $this->input_type === 'text' ? 'bi bi-eye-slash-fill' : 'bi bi-eye-fill';
        $this->input_title = $this->input_type === 'text' ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi';
    }

    /**
     * Authenticate the user and redirect to the dashboard if successful.
     */
    public function authenticate(): void
    {
        $this->validate();

        if (Auth::attempt($this->only(['email', 'password']), $this->remember_me)) {
            session()->regenerate();

            $this->redirect(Dashboard::class);
        }

        session()->flash('error', 'Alamat email atau kata sandi salah!');
        $this->reset('password');
    }

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.authentication.login');
    }
}
