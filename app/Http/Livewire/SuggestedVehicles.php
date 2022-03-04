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
    public $token;
    public $client;
    protected $queryString = ['client_id','token'];
    public $suggested_vehicles, $records;
    public $allow_login;
    public $read_neo_api = true;
    public $downpayment = 0;
    public $downpayment_ranges = [];
    public $client_has_vehicles_with_downpayment=false;
    public $show_garage = false;
    public $header_page = 'Vehicles you are approved';
    public $count_garage;
    PUBLIC $client_first_time = false;


    public function mount(){
        $this->read_client_id();
        $this->close_expired_sessions();
        $this->read_neo_api = env('APP_READ_NEO_API',true);
        $this->allow_login = $this->allow_login();
        if($this->allow_login && $this->client){
            $this->client->update_loggin_times();
            $this->get_garage();
        }

        if($this->garage && $this->garage->occupied_spaces()){
            $this->add_interval_to_client_session($this->garage->occupied_spaces() * env('SESSION_INTERVAL'));
        }
    }

    public function render()
    {
        /** To Do
         * (1) Validar que la sesión no haya expirado de ser así enviar una vista con el informe.
        */

        if(!$this->allow_login){
            return view('livewire.suggested_vehicles.incorrect_link');
        }

        if($this->read_neo_api && $this->client){
            $this->load_suggested_vehicles();
        }


        if($this->garage){
            $this->review_garage();
            $this->count_garage = $this->garage->vehicles_in_garages()->count();
        }

        if($this->show_garage && $this->garage){
            $this->read_vehicles_in_garage();

        }else{
            $this->read_suggested_vehicles();
        }

        return view('livewire.suggested_vehicles.vehicles');
    }

    /** Lee vehículos en el garage */
    private function read_suggested_vehicles(){
        $this->header_page = 'Vehicles you are approved';
        $this->client_has_vehicles_with_downpayment = $this->client->has_vehicles_with_downpayment();
        $this->records = $this->read_suggested_vehicles_client_id($this->client->id,$this->downpayment); // Lee sugeridos del cliente;
    }

    /** Lee vehículos sugeridos  */
    private function read_vehicles_in_garage(){
        $this->records = $this->garage->vehicles_in_garages()->get();
        $this->client_has_vehicles_with_downpayment = false;
        $this->header_page = 'My Garage';
    }

    public function set_show_garage(){
        $this->show_garage = !$this->show_garage;
    }
}
