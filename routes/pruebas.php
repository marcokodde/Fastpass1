<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TestController;

Route::get('test_controller/{parametro}',TestController::class)->name('test_controller');
