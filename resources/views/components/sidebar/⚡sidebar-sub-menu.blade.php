<?php

use Livewire\Component;

/**
 * Collapsible sidebar submenu with active state tracking
 */
new class extends Component
{
    // Menu icon CSS classes
    public string $icon;

    // Menu title text
    public string $title;

    // Active state of the menu
    public bool $active;
};
?>

<div>
  <li class="sidebar-item has-sub {{ $active ? 'active' : '' }}">
    <a href="#" class='sidebar-link'>
      <i class="{{ $icon }}"></i>
      <span>{{ $title }}</span>
    </a>
    <ul class="submenu">
      {{ $slot }}
    </ul>
  </li>
</div>