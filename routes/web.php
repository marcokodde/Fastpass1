<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Livewire\NewShowVehiclesController;
use App\Http\Livewire\WelcomeController;


Route::get('/',WelcomeController::class)->name('suggested_vehicles');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('update_inventory', [InventoryController::class, 'update_inventory'])->name('update_inventory');
Route::get('show_vehicles/{client_id}/{token?}',NewShowVehiclesController::class)->name('show_vehicles');

require 'pruebas.php';
