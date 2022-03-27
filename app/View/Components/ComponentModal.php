<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentModal extends Component
{
    public $idModal ;
    public $classModalDialog ;
    public $classSize ;
    public $action ;
    public $nameComponent ;
    public function __construct(string $idModal,string $action,string $nameComponent, 
    string $classModalDialog,string $classSize)
    {
        $this->idModal = $idModal;
        $this->classModalDialog = $classModalDialog;
        $this->classSize = $classSize;
        $this->action = $action;
        $this->nameComponent= $nameComponent;
    }

    public function render()
    {
        return view('components.component-modal');
    }
}
