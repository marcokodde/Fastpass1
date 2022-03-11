<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Livewire\NewShowVehiclesController;
use App\Http\Livewire\WelcomeController;

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Carga los venículos sugeridos
Route::get('/',WelcomeController::class)->name('suggested_vehicles');
// Mostrar los venículos remoendados
Route::get('show_vehicles/{client_id}/{token?}',NewShowVehiclesController::class)->name('show_vehicles');

// Inventario e imágenes
Route::get('update_inventory', [InventoryController::class, 'update_inventory'])->name('update_inventory');
Route::get('update_images_history', [InventoryController::class, 'update_images_history'])->name('update_images_history');

// Pruebas
require 'pruebas.php';
