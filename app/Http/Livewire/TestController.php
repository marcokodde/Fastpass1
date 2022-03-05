<?php

namespace App\Http\Livewire;

use App\Models\SuggestedVehicle;
use Livewire\Component;

class TestController extends Component
{
    public $saludo;
    public function render()
    {

       return view('livewire.test-controller');
    }

    public function destroy($stock){
        $this->saludo = "El vehículo a agregar es el stock # " . $stock;
    }
}
