<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class HomeController extends Component
{
    public function render()
    {
        return view('livewire.admin.home-controller')
        ->extends('layouts.admin.app')->section('content');
    }
}
