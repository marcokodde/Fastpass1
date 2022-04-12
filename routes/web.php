<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Livewire\Clients;
use App\Http\Livewire\Locators;
use App\Http\Livewire\NewShowVehiclesController;
use App\Http\Livewire\Reasons;
use App\Http\Livewire\Sources;
use App\Http\Livewire\TestController;
use App\Http\Livewire\WelcomeController;

Route::get('queries/total_clients',Clients::class)->name('total_clients');
require 'pruebas.php';

Route::middleware(['auth'])->group(function () {
    Route::get('locators', Locators::class)->name('locators');      // Localidades
    Route::get('sources', Sources::class)->name('sources');         // Fuentes de como nos conoció
    Route::get('reasons', Reasons::class)->name('reasons');         // Motivos
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Inventario e imágenes
Route::get('update_inventory', [InventoryController::class, 'update_inventory'])->name('update_inventory');
Route::get('update_images_history', [InventoryController::class, 'update_images_history'])->name('update_images_history');


Route::get('/', function () {
    return view('welcome');
});
Route::get('expire_session',function(){
    return view('livewire.session.session_expired');
})->name('expire_sesion');

Route::get('show_vehicles/{client_id}/{token?}',NewShowVehiclesController::class)->name('show_vehicles');

Route::get('/{client_id}/{token?}',WelcomeController::class)->name('suggested_vehicles');

Route::get('inventory/show/{vehicle}', [NewShowVehiclesController::class, 'show'])->name('show_images');


