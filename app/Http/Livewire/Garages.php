<?php

namespace App\Http\Livewire;

use App\Models\Garage;
use Livewire\Component;
use App\Models\DetailGarage;
use App\Http\Livewire\Traits\ApiTrait;
use App\Http\Livewire\Traits\GarageTrait;
use App\Http\Livewire\Traits\SessionClientTrait;
use App\Http\Livewire\Traits\SuggestedVehiclesTrait;



class Garages extends Component
{
    use SessionClientTrait;
    use GarageTrait;
    use ApiTrait;
    use SuggestedVehiclesTrait;

    public $garages;
    public $client_id;
    public $client;
    protected $queryString = ['client_id'];

    protected $listeners = ['mount',
                            'client_id' => 'garage'
                        ];

    public function mount() {
        $value = $this->get_garage();
        /** TO DO
         * (1) Solo los vehículos del cliente en el garage
         * (2) Refactorización para usar funciones del GarageTrait como get_garage....
         * (3) Usar un boolean para la vista.
         * (4) Ver cómo leer el client_id, porque dado que este componente está incrustado en otra página
         *     hay que heredarlo o recibirlo por parámetro.. etc.
        */
        $this->garages = DetailGarage::all();
    }

    public function garage($client_id) {
        $this->client_id = $client_id;
    }

    public function render()
    {
        return view('livewire.garages.index');
    }
}