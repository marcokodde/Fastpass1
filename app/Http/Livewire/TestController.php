<?php

namespace App\Http\Livewire;

use App\Models\SuggestedVehicle;
use Livewire\Component;

class TestController extends Component
{
    public $izquierdo_minimo = 500;
    public $izquierdo_maximo = 3500;
    public $izquierdo_valor = 500;
    public $derecho_minimo=1000;
    public $derecho_maximo=4000;
    public $derecho_valor = 4000;

    public $range_step=500;

    // Cuando Izquierdo minimo se sube.... Derecho Minimo se sube (Izquierdo Minimo + 500)
    // Cuando Derecho maximo se sube.... Izquierdo Maximo se baja: (Derecho Maximo - 500 )

    public $downpayment=500;
    public $downpayment_min=500;
    public $downpayment_max=4000;
    public $max_izquierda = 3500;
    public $min_derecha   = 4000;



    public function mount(){


    }
    public function render()
    {

       return view('livewire.test-controller');
    }

        // Cuando Izquierdo minimo se sube.... Derecho Minimo se sube (Izquierdo Minimo + 500)
    public function actualiza_minimo_derecho(){
        $this->derecho_minimo = $this->izquierdo_valor + $this->range_step;
        $this->derecho_maximo = $this->downpayment_max;
    }

    // Cuando Derecho maximo se sube.... Izquierdo Maximo se baja: (Derecho Maximo - 500 )
    public function actualiza_maximo_izquierdo(){
        $this->izquierdo_maximo = $this->derecho_valor - $this->range_step;
    }

}
