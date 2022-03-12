<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TestController;

Route::get('test_controller',TestController::class)->name('test_controller');

