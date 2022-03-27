<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentInput extends Component
{
    public $name;
    public $label;
    public $placeholder;
    public $type;
    public function __construct(string $label,string $placeholder, string $name,string $type)
    {
        $this->label = $label;
        $this->name= $name;
        $this->placeholder = $placeholder;
        $this->type = $type;
    }

    public function render()
    {
        return view('components.component-input');
    }
}
