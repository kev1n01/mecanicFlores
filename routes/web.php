<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::group(['middleware' => ['auth:sanctum', 'verified'],'prefix' => 'admin'], function () {
    Route::get('/dashboard', function (){ return view('dashboard');})->name('dashboard');
    
    Route::get('myprofile',function(){return view('profile.show');})->name('user.myprofile');

    Route::get('/home', \App\Http\Livewire\Admin\HomeController::class)->name('home')
    ->middleware('can_view:usuario');

    Route::get('/users', \App\Http\Livewire\Admin\User\Index::class)->name('users.index')
    ->middleware('can_view:usuario');
    
    Route::get('/roles', \App\Http\Livewire\Admin\Role\LiveRoleTable::class)->name('roles.index')
    ->middleware('can_view:role');
});
