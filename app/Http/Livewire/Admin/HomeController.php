<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
class HomeController extends Component
{
    public function render()
    {
        return view('livewire.admin.home-controller')
            ->extends('layouts.admin.app')->section('content');
    }


}
