<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PriceRange extends Component
{
    public $name;
    public $label;
    public $min;
    public $max;
    public $step;
    public $value;
    public $min_label;
    public $max_label;

    public function __construct($name, $label, $min, $max, $step, $value, $min_label, $max_label)
    {
        $this->name = $name;
        $this->label = $label;
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
        $this->value = $value;
        $this->min_label = $min_label;
        $this->max_label = $max_label;
    }

    public function render()
    {
        return view('components.price-range');
    }
}
