<?php

use App\Http\Livewire\Mygarages;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Additionalhitch;
use App\Http\Livewire\SuggestedVehicles;
use App\Http\Controllers\FastPassController;
use App\Http\Controllers\InventoryController;
use App\Http\Livewire\ShowVehiclesController;
use App\Http\Livewire\TimeRemainder;
use App\Http\Livewire\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',WelcomeController::class)->name('welcome');

// Route::get('/', function () {
//     return view('welcome');
// });

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

Route::get('show_vehicles_client_token/{client_id}/{token}',ShowVehiclesController::class)->name('show_vehicles_client_token');
Route::get('show_vehicles_client/{client_id}',ShowVehiclesController::class)->name('show_vehicles_client');
