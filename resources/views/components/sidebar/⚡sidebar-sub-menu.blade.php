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

    // Routes that belong to this submenu
    public array $subMenuRoutes = [];

    // Is the submenu currently active?
    public bool $isActive = false;

    /**
     * Initialize component with data
     */
    public function mount(array $subMenuRoutes = []): void
    {
        $this->subMenuRoutes = $subMenuRoutes;
        $this->checkActiveState();
    }

    /**
     * Determine if current page is in this submenu
     */
    public function checkActiveState(): void
    {
        $currentUrl = url()->current();

        // Loop through all routes in this submenu
        foreach ($this->subMenuRoutes as $routeName) {
            try {
                // Convert route name to full URL
                $routeUrl = route($routeName);

                // Check if current page matches
                if ($currentUrl === $routeUrl) {
                    $this->isActive = true;

                    return; // Stop checking once active is found
                }
            } catch (\Exception $e) {
                // Skip routes that don't exist
                continue;
            }
        }

        // No matching routes found
        $this->isActive = false;
    }
};
?>

<div>
  <li class="sidebar-item has-sub {{ $isActive ? 'active' : '' }}">
    <a href="#" class='sidebar-link'>
      <i class="{{ $icon }}"></i>
      <span>{{ $title }}</span>
    </a>
    <ul class="submenu">
      {{ $slot }}
    </ul>
  </li>
</div>
