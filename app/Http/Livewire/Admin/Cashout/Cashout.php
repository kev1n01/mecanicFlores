<?php

namespace App\Http\Livewire\Admin\Cashout;

use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Cashout extends Component
{
    public $fromDate,$toDate,$userid,$total,$items,$sales,$details;

    public function mount(){
        $this->fromDate = null;
        $this->toDate = null;
        $this->userid = 0;
        $this->total = 0;
        $this->sales = [];
        $this->details = [];

    }
    public function render()
    {
        return view('livewire.admin.cashout.cashout',[
            'users' => User::orderBy('name','asc')->get()
        ])->extends('layouts.admin.app')->section('content');
    }
    public function consultar(){
        $fi = Carbon::parse($this->fromDate)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($this->toDate)->format('Y-m-d').' 23:59:59';
        $this->sales = Sale::whereBetween('created_at',[$fi,$ff])
            ->where('user_id',$this->userid)->get();
//        dd($this->sales);
        if(!$this->sales ){
            $this->emit('warning_alert', 'El usuario que seleccionó no hizo ninguna venta en las fechas seleccionadas');
        }

        $this->total = $this->sales ?  $this->sales->sum('total') : 0;
        $this->items = $this->sales ?  $this->sales->sum('items') : 0;
    }

    public function viewDetails(Sale $sale){
        $fi = Carbon::parse($this->fromDate)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($this->toDate)->format('Y-m-d').' 23:59:59';

        $this->emit('toogleModalDetail',$fi,$ff,$this->userid,$sale->id);
    }
    public function print(){

    }
}
