<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/admin/panel',[\App\Http\Controllers\HomeController::class,'redirectUser'])->name('admin.dashboard');

//Ruta prueba para exportacion en pdf
Route::get('/report/usuarios', [\App\Http\Livewire\Admin\User\Index::class,'pdfdownload'])->name('users.pdf');
Route::get('/report/products', [\App\Http\Livewire\Admin\Product\LiveProductTable::class,'pdfdownload'])->name('products.pdf');


//Ruta vista home sin auth
Route::get('/', \App\Http\Livewire\User\HomeController::class)->name('user.home');

//Rutas con prefix user
Route::group(['middleware' => ['auth:sanctum'],'prefix' => 'user'], function () {
    //Ruta para redirigir al home del user
//    Route::get('/home', \App\Http\Livewire\User\HomeController::class)->name('user.home')
//        ->middleware('can_view:cliente');

});


//Rutas con prefix admin
Route::group(['middleware' => ['auth:sanctum'],'prefix' => 'admin'], function () {
    //Rutas de perfil de usuario admin
    Route::get('myprofile',function(){return view('profile.show');})->name('user.myprofile');

//    Ruta para redirigir al home del admin
    Route::get('/home', \App\Http\Livewire\Admin\HomeController::class)->name('admin.home')
    ->middleware('can_view:usuario');

    // Rutas de usuario y permisos
    Route::get('/users', \App\Http\Livewire\Admin\User\Index::class)->name('users.table')
    ->middleware('can_view:usuario');
    Route::get('/roles', \App\Http\Livewire\Admin\Role\LiveRoleTable::class)->name('roles.table')
    ->middleware('can_view:role');

    //Rutas de inventario
    Route::get('/products',\App\Http\Livewire\Admin\Product\LiveProductTable::class)->name('products.table')
        ->middleware('can_view:vendedor');
    Route::get('/providers',\App\Http\Livewire\Admin\Provider\LiveProviderTable::class)->name('providers.table')
        ->middleware('can_view:usuario');
    Route::get('/purchases',\App\Http\Livewire\Admin\Purchase\LivePurchaseTable::class)->name('purchases.table')
        ->middleware('can_view:usuario');
    Route::get('/purchases/create',\App\Http\Livewire\Admin\Purchase\LiveCreatePurchase::class)->name('purchases_create.table')
        ->middleware('can_view:usuario');

    //Rutas para venta
    Route::get('/sales/create',\App\Http\Livewire\Admin\Sale\LiveCreateSale::class)->name('sales.create')
        ->middleware('can_view:vendedor');
    Route::get('/sales',\App\Http\Livewire\Admin\Sale\LiveSaleTable::class)->name('sales.table')
        ->middleware('can_view:vendedor');

    //Rutas para reporte de caja
    Route::get('/report/sale/seller',\App\Http\Livewire\Admin\Cashout\Cashout::class)->name('report.sale.seller')
        ->middleware('can_view:vendedor');

});
