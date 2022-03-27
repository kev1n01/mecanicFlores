<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentInputFile extends Component
{
    public $name;
    public $label;

    public function __construct(string $name, string $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.component-input-file');
    }
}
