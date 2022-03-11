<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Livewire\NewShowVehiclesController;
use App\Http\Livewire\WelcomeController;

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});
Route::get('expire_session',function(){
    return view('livewire.session_expired');
})->name('expire_sesion');
Route::get('show_vehicles/{client_id}/{token?}',NewShowVehiclesController::class)->name('show_vehicles');
Route::get('/{client_id}/{token?}',WelcomeController::class)->name('suggested_vehicles');


// Inventario e imágenes
Route::get('update_inventory', [InventoryController::class, 'update_inventory'])->name('update_inventory');
Route::get('update_images_history', [InventoryController::class, 'update_images_history'])->name('update_images_history');

// Pruebas
require 'pruebas.php';
