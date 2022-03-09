<?php

use App\Http\Livewire\Mygarages;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Additionalhitch;
use App\Http\Livewire\SuggestedVehicles;
use App\Http\Controllers\FastPassController;
use App\Http\Controllers\InventoryController;
use App\Http\Livewire\NewShowVehiclesController;
use App\Http\Livewire\TimeRemainder;
use App\Http\Livewire\WelcomeController;


Route::get('/',WelcomeController::class)->name('suggested_vehicles');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('link_neo/{neo_id}', [FastPassController::class, 'inventory_stock'])->name('inventory_stock');

// Enlace que recibe el cliente
Route::get('suggested_vehicles',SuggestedVehicles::class)->name('suggested_vehicles');
Route::get('additional_hitch',Additionalhitch::class)->name('additional_hitch');
Route::get('my_garage',Mygarages::class)->name('my_garage');

Route::get('time_remainder',TimeRemainder::class)->name('time_remainder');
Route::get('update_inventory', [InventoryController::class, 'update_inventory'])->name('update_inventory');

Route::get('show_vehicles/{client_id}/{token?}',NewShowVehiclesController::class)->name('show_vehicles');

