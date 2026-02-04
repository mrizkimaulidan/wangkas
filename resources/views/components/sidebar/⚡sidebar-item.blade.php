<?php

use Livewire\Component;

new class extends Component
{
    // The destination URL for this menu item
    public string $url;

    // Icon classes (e.g., from Bootstrap Icons: 'bi bi-house-door')
    public string $icon;

    // Display text shown to users
    public string $title;

    // Active state of the menu
    public bool $active;
};
?>

<div>
  <li class="sidebar-item {{ $active ? 'active' : '' }}">
    <a href="{{ $url }}" class='sidebar-link' wire:navigate>
      <i class="{{ $icon }}"></i>
      <span>{{ $title }}</span>
    </a>
  </li>
</div>