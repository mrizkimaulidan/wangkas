<?php

use Livewire\Component;

new class extends Component
{
    // The destination URL for this menu item
    public string $url;

    // Display text shown to users
    public string $title;

    // Active state of the menu
    public bool $active;
};
?>

<div>
  <li class="submenu-item {{ $active ? 'active' : '' }}">
    <a href="{{ $url }}" class="submenu-link" wire:navigate>
      {{ $title }}
    </a>
  </li>
</div>