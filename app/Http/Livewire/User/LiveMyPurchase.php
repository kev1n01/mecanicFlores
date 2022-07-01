<?php

namespace App\Http\Livewire\User;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LiveMyPurchase extends Component
{
    public $total,$items;

    public function render()
    {
        $sales = Sale::where('customer_id',Auth::user()->id)->get();
        $this->total = $sales ?  $sales->sum('total') : 0;
        $this->items = $sales ?  $sales->sum('items') : 0;

        return view('livewire.user.live-my-purchase',compact('sales'))
            ->extends('layouts.user.app')->section('content');
    }

    public function viewDetails(Sale $sale){
        $this->emit('toogleModalDetail',$sale->id);
    }
}
