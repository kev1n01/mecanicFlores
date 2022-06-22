<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirectUser(){
        if (!Auth::user()){
            return redirect()->route('login');
        }
        if (Auth::user()->roles()->first()->name === 'cliente'){
            return redirect()->route('user.home');
        }
        if (Auth::user()->roles()->first()->name === 'administrador'){
            return redirect()->route('admin.home');
        }
        if (Auth::user()->roles()->first()->name === 'vendedor'){
            return redirect()->route('sales.create');
        }
        if (Auth::user()->roles()->first()->name === 'empleado'){
            return redirect()->route('user.myprofile');
        }
    }
}
