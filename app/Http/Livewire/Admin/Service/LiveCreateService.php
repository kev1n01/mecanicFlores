<?php

namespace App\Http\Livewire\Admin\Service;

use Livewire\Component;

class LiveCreateService extends Component
{
    public function render()
    {
        return view('livewire.admin.service.live-create-service')
            ->extends('layouts.admin.app')->section('content');;
    }
}
