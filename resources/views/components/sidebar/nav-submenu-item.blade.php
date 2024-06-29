@props(['active' => false])
@php
$isActive = $active ? 'active' : ''
@endphp

<li {{ $attributes->merge(['class' => 'submenu-item ' . $isActive]) }}>
	{{ $slot }}
</li>