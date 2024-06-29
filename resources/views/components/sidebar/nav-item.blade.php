@props(['active' => false])
@php
$isActive = $active ? 'active' : ''
@endphp

<li {{ $attributes->merge(['class' => 'sidebar-item ' . $isActive]) }}>
	{{ $slot }}
</li>