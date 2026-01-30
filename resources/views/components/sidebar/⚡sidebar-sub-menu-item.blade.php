<?php

use Livewire\Component;

new class extends Component
{
    // The destination URL for this menu item
    public string $url;

    // Display text shown to users
    public string $title;
};
?>

<div>
  <li class="submenu-item {{ url()->current() === $url ? 'active' : '' }}">
    <a href="{{ $url }}" class="submenu-link" wire:navigate>
      {{ $title }}
    </a>
  </li>
</div>
