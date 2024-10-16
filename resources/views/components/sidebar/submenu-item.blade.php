@php
$isActive = $active ? 'active' : ''
@endphp

<li {{ $attributes->class(['submenu-item', 'active' => $isActive]) }}>
  {{ $slot }}
</li>
