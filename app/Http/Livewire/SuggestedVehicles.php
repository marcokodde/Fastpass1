<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\ApiTrait;
use App\Http\Livewire\Traits\GarageTrait;
use App\Http\Livewire\Traits\SessionClientTrait;
use App\Http\Livewire\Traits\SuggestedVehiclesTrait;
use Livewire\Component;

class SuggestedVehicles extends Component
{

    use SessionClientTrait;
    use GarageTrait;
    use ApiTrait;
    use SuggestedVehiclesTrait;


    public $client_id;
    protected $queryString = ['client_id'];
    public $suggested_vehicles, $records;
    public $allow_login;

    public function mount(){
        $this->close_expired_sessions();
        $this->allow_login = $this->allow_login();
        $this->get_garage();

    }

    public function render()
    {
        /** To Do
         * (1) Validar que la sesión no haya expirado de ser así enviar una vista con el informe.
        */

        $this->read_vehicles();
        return view('livewire.suggested_vehicles.vehicles');
    }


    /** Lee los vehículos */
    private function read_vehicles(){
        $client = $this->read_client_id();
        if($client){
            $this->delete_suggested_vehicles_client($client->id);               // Elimina vehículos sugeridos del cliente
            $records = $this->read_api_suggested_vehicles();                    // Lee los sugeridos desde NEO
            $this->create_suggested_vehicles_to_client($records,$client->id);   // Llena sugeridos del cliente desde inventario local
            $this->records = $this->read_suggested_vehicles_client_id($client->id,1000); // Lee sugeridos del cliente;
        }
        // foreach($this->records as $record){
        //     dd($record->inventory->dealer_id);
        // }
        dd($this->records);
        if($this->garage){
            $this->review_garage();
        }
    }

    public function ok() { dd("okokoko");}
}
