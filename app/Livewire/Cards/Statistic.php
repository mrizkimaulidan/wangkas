<?php

namespace App\Livewire\Cards;

use Livewire\Component;

class Statistic extends Component
{
    public string $icon;

    public string $color;

    public string $title;

    public string $count;

    public function render()
    {
        return view('livewire.cards.statistic');
    }

    public function placeholder()
    {
        return view('livewire.placeholders.card-statistic');
    }
}
