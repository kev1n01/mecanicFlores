<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class LiveAboutController extends Component
{
    public function render()
    {
        return view('livewire.user.live-about-controller')
            ->extends('layouts.user.app')->section('content');
    }
}
