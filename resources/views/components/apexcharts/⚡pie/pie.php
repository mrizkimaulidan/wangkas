<?php

use Livewire\Component;

new class extends Component
{
    /**
     * Chart title to be displayed
     */
    public string $title;

    /**
     * Unique identifier for the chart container element
     * Used by ApexCharts to target the DOM element
     */
    public string $chartID;

    /**
     * Array of data series for ApexCharts
     * Format: [['name' => 'Series 1', 'data' => [1,2,3]], ...]
     */
    public array $series;

    /**
     * Array of colors for chart elements
     * Supports hex codes, rgb, rgba, and CSS color names
     * Example: ['#FF0000', '#00FF00', '#0000FF']
     */
    public array $colors;
};
