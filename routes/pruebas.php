<?php

use App\Http\Livewire\RangeSlider;
use Illuminate\Support\Facades\Http;
use App\Http\Livewire\TestController;
use App\Models\Client;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Client\RequestException;

Route::get('test_controller',TestController::class)->name('test_controller');

Route::get('range_slider',RangeSlider::class)->name('range_slider');




