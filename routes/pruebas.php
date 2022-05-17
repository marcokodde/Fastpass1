<?php

use App\Http\Livewire\RangeSlider;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TestController;

Route::get('test_controller',TestController::class)->name('test_controller');

Route::get('range_slider',RangeSlider::class)->name('range_slider');

Route::get('insert_lead_neo',function(){
    try {
        $response = Http::withHeaders([
            'Connection' => 'keep-alive',
            'Access-Token' => 'dRfgmuyehzDmagMcz62wrRiqa',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'])
        ->post('https://api.neoverify.com/v1/add_lead', [
                    'advertising_source'    =>  'Prueba desde Ahava Marketing',
                    'referral_source'       =>  'Facebook',
                    'campaign'              =>  'Nombre de Campaña',
                    'applicant'             =>  [
                        'first_name'    => 'Primer Nombre',
                        'middle_name'   => 'Segundo Nombre',
                        'last_name'     => 'Apellido',
                        'email_address' => 'correo_aplicant@domain.com',
                        'cell_phone_number' => '1234567890',
                        'home_phone_number' => '1234567890',
                        'work_phone_number' => '1234567890'
                    ]
            ]);
        return $response->json();
    } catch (RequestException $ex) {
        return response()->json(['error' => $ex->getMessage()], 500);
    }
});
