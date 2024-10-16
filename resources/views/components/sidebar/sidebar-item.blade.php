@php
$isActive = $active ? 'active' : ''
@endphp

<li {{ $attributes->class(['sidebar-item', 'active' => $isActive]) }}>
  {{ $slot }}
</li>
