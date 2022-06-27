<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class LiveContactController extends Component
{
    public function render()
    {
        return view('livewire.user.live-contact-controller')
            ->extends('layouts.user.app')->section('content');
    }
}
