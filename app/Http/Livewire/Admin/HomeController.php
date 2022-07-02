<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
class HomeController extends Component
{
    public function mount(){
        $this->customers = User::role('cliente')->count();
        $this->products = Product::count();
        $this->purchases = Purchase::count();
        $this->sales = Sale::count();
//        dd($this->customers);
    }
    public function render()
    {
        $chart_options = [
            'chart_title' => 'Compras de la semana',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Purchase',
            'group_by_field' => 'created_at',
            'group_by_period' => 'week',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart_options);
        $chart_options = [
            'chart_title' => 'Ventas de la dia',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Sale',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_field' => 'total',
            'chart_type' => 'line',
            'continuous_time' => true,
        ];
        $chart2 = new LaravelChart($chart_options);

        return view('livewire.admin.home-controller',compact('chart1','chart2'))
            ->extends('layouts.admin.appenetero')->section('content');
    }


}
