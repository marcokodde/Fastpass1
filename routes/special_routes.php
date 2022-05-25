<?php

use App\Http\Livewire\Clients;
use App\Http\Livewire\ResetClients;
use Illuminate\Support\Facades\Route;


use App\Models\Client;




//Route::get('range_slider',RangeSlider::class)->name('range_slider');

Route::get('calculadora',function(){
    return view('calculadora.index');
});

Route::get('queries/total_clients',Clients::class)->name('total_clients');
//Route::get('reset_clients',ResetClients::class)->name('reset_clients');

Route::get('queries/reset/client_id/{client_id}',function($client_id){

    $client = Client::ClientId($client_id)->first();

    if($client){
        $client->suggested_vehicles()->delete();
        $client->garages()->delete();
        $client->delete();
    }
    $client = Client::ClientId($client_id)->first();
    if(!$client){
        return 'Los Datos del Cliente Han Sido Eliminados';
    }
});


