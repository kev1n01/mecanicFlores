<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class LiveProfileController extends Component
{
    public function render()
    {
        return view('livewire.user.live-profile-controller')
            ->extends('layouts.user.app')->section('content');
    }
}
