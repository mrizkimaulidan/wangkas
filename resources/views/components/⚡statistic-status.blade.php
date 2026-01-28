<?php

use Livewire\Component;

new class extends Component
{
    // Main display properties
    public string $label;        // Title/heading of the stat card
    public $value;               // Main value (can be string or numeric)
    public string $icon;         // Bootstrap icon class (e.g., 'bi-people')
    public string $color = 'primary'; // Color theme for the card

    // Option 1: For trend indicators (increase/decrease)
    public bool $showTrend = false;         // Whether to show trend badge
    public string $trendDirection = 'up';   // 'up' for increase, 'down' for decrease
    public string $trendPercentage = '';    // Percentage value (e.g., '+10%')
    public string $comparisonText;

    // Option 2: For additional info (without trend)
    public $subValue = null;     // Secondary value (e.g., percentage, count)
    public string $subLabel = ''; // Secondary description text
};
?>

<div>
  @placeholder
  <div class="card border-0 shadow-sm">
    <div class="card-body p-3">
      <div class="d-flex align-items-start">
        <div class="me-3">
          <div class="rounded-2 p-3 placeholder">
            <div class="placeholder" style="width: 48px; height: 48px;"></div>
          </div>
        </div>

        <div class="flex-grow-1">
          <div class="mb-2 placeholder-glow">
            <h5 class="fs-3 fw-bold mb-0">
              <span class="placeholder col-7"></span>
            </h5>
            <p class="text-muted mb-0">
              <span class="placeholder col-4"></span>
            </p>
          </div>

          <div class="mt-2 placeholder-glow">
            <span class="placeholder col-2 me-2" style="height: 24px;"></span>
            <span class="placeholder col-3" style="height: 16px;"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endplaceholder

  <div class="card border-0 shadow-sm">
    <div class="card-body p-3">
      <div class="d-flex align-items-start">

        <div class="me-3">
          <div class="bg-{{ $color }}-subtle rounded-2 p-3">
            <i class="{{ $icon }} text-{{ $color }} fs-3"></i>
          </div>
        </div>

        <div class="flex-grow-1">
          <div class="mb-2">
            <h5 class="fs-3 fw-bold mb-0">{{ $value }}</h5>
            <p class="text-muted mb-0">{{ $label }}</p>
          </div>

          @if($showTrend && $trendPercentage)
          <div class="d-flex align-items-center mt-2">
            <span
              class="badge bg-{{ $trendDirection === 'up' ? 'success' : 'danger' }}-subtle text-{{ $trendDirection === 'up' ? 'success' : 'danger' }} border-0 py-1 px-2 me-2">
              <i class="bi bi-graph-{{ $trendDirection }}-arrow fs-6 me-1"></i>
              <span class="fw-medium">{{ $trendPercentage }}</span>
            </span>
            <span class="text-muted small">{{ $comparisonText }}</span>
          </div>

          @elseif($subValue || $subLabel)
          <div class="mt-2">
            @if($subValue)
            <span class="badge bg-{{ $color }}-subtle text-{{ $color }} border-0 py-1 px-2 me-2">
              {{ $subValue }}
            </span>
            @endif

            @if($subLabel)
            <span class="text-muted small">{{ $subLabel }}</span>
            @endif
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>