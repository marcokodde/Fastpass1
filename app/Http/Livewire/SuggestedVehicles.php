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
    public $show_garage = false;
    public $header_page = 'Vehicles you are approved';


    public function mount(){
        $this->close_expired_sessions();
        $this->allow_login = $this->allow_login();
        $this->client = $this->read_client_id();
        $this->read_neo_api = env('APP_READ_NEO_API',true);
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


        if($this->garage){
            $this->review_garage();
        }

        if($this->show_garage && $this->garage){
            $this->records = $this->garage->vehicles_in_garages()->get();
            
            $this->client_has_vehicles_with_downpayment = false;
            $this->header_page = 'Vehicles in my Garage';
            return view('livewire.suggested_vehicles.vehicles');
        }else{
            $this->header_page = 'Vehicles you are approved';
            $this->client_has_vehicles_with_downpayment = $this->client->has_vehicles_with_downpayment();
            $this->records = $this->read_suggested_vehicles_client_id($this->client->id,$this->downpayment); // Lee sugeridos del cliente;
            return view('livewire.suggested_vehicles.vehicles');
        }




    }


    public function set_show_garage(){
        $this->show_garage = !$this->show_garage;
    }


    public function ok() { dd("okokoko");}
}
