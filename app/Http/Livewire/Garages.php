<?php

namespace App\Http\Livewire;

use App\Models\Garage;
use Livewire\Component;
use App\Models\DetailGarage;
use App\Http\Livewire\Traits\GarageTrait;



class Garages extends Component
{
    use GarageTrait;

    public $garages;
    protected $listeners = ['mount'];

    public function mount() {
        /** TO DO
         * (1) Solo los vehículos del cliente en el garage
         * (2) Refactorización para usar funciones del GarageTrait como get_garage....
         * (3) Usar un boolean para la vista.
         * (4) Ver cómo leer el client_id, porque dado que este componente está incrustado en otra página
         *     hay que heredarlo o recibirlo por parámetro.. etc.
        */

        $this->garages = DetailGarage::all();
    }

    public function render()
    {
        return view('livewire.garages.index');
    }


}
