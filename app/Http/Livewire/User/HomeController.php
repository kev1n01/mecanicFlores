<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class HomeController extends Component
{
    public function render()
    {
        return view('livewire.user.home-controller')
            ->extends('layouts.admin.app')->section('content');
    }
}
