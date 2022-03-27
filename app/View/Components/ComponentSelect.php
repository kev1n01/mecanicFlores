<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentSelect extends Component
{
    public $options ;
    public $name;
    public $label;
    public $placeholder;
    public function __construct($options,string $name,string $label, string $placeholder)
    {
        $this->options = $options;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.component-select');
    }
}
