<?php

namespace App\Http\Livewire;

use App\Models\SuggestedVehicle;
use Livewire\Component;

class TestController extends Component
{
    public $saludo;
    public function render()
    {
        for($i=1;$i<=100;$i++){
            echo bin2hex(random_bytes(24)) . '<br>';
        }

        return view('livewire.test-controller');
    }

    public function saludo($nombre){
        dd($nombre);
        $this->saludo ='Hola ' . $nombre;
    }
}
