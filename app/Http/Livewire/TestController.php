<?php

namespace App\Http\Livewire;

use App\Models\SuggestedVehicle;
use Livewire\Component;

class TestController extends Component
{
    public $saludo;
    public function render()
    {
        $recorods = SuggestedVehicle::ClientId(1)
                    ->DownPayment(500)
                    ->get();
        dd($recorods);
        return view('livewire.test-controller');
    }

    public function saludo($nombre){
        dd($nombre);
        $this->saludo ='Hola ' . $nombre;
    }
}
