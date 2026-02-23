<?php

use Carbon\Carbon;
use Livewire\Component;

new class extends Component
{
    public Carbon $timestamp;
};
?>

<div>
  <div class="border rounded p-3 mb-4">
    <div class="small">
      <i class="bi bi-clock-history text-primary me-1"></i>
      <strong>Terakhir diperbarui:</strong>
      <span>{{ $timestamp->translatedFormat('d F Y H:i') ?? '-' }}</span>
    </div>
  </div>
</div>
