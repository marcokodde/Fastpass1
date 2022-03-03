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
    public $client;
    protected $queryString = ['client_id'];
    public $suggested_vehicles, $records;
    public $allow_login;
    public $read_neo_api = true;
    public $downpayment = 0;
    public $downpayment_ranges = [];
    public $client_has_vehicles_with_downpayment=false;


    public function mount(){
        $this->close_expired_sessions();
        $this->allow_login = $this->allow_login();
        $this->client = $this->read_client_id();
        $this->get_garage();

    }

    public function render()
    {
        /** To Do
         * (1) Validar que la sesión no haya expirado de ser así enviar una vista con el informe.
        */
        if($this->read_neo_api && $this->client){
            $this->load_suggested_vehicles();
        }
        $this->client_has_vehicles_with_downpayment = $this->client->has_vehicles_with_downpayment();
        $this->records = $this->read_suggested_vehicles_client_id($this->client->id,$this->downpayment); // Lee sugeridos del cliente;
        if($this->garage){
            $this->review_garage();
        }

        return view('livewire.suggested_vehicles.vehicles');
    }





    public function ok() { dd("okokoko");}
}
