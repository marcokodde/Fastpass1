<?php

use App\Http\Livewire\RangeSlider;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TestController;

Route::get('test_controller',TestController::class)->name('test_controller');

Route::get('range_slider',RangeSlider::class)->name('range_slider');
