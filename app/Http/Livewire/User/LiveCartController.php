<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class LiveCartController extends Component
{
    public function render()
    {
        return view('livewire.user.live-cart-controller')
            ->extends('layouts.user.app')->section('content');;
    }
}
