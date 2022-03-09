<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Http\Livewire\Traits\ApiTrait;
use App\Http\Livewire\Traits\GarageTrait;
use App\Http\Livewire\Traits\SessionClientTrait;
use App\Http\Livewire\Traits\SuggestedVehiclesTrait;

class ShowVehiclesController extends Component
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
    public $downpayment = 250;
    public $downpayment_ranges = [];
    public $client_has_vehicles_with_downpayment=false;
    public $show_garage = false;
    public $show_additional = false;
    public $header_page = 'Vehicles you are approved';
    public $count_garage;
    public $client_first_time = false;


    // Inicio del componente:
    public function mount($client_id,$token){
        dd('Cliente=' . $client_id . ' Token=' . $token);
        $this->client_id = $client_id;
        $this->read_client();
        $this->close_expired_sessions();
        if($this->client){
            $this->allow_login = $this->allow_login();
        }
        if ($this->allow_login) {
            $this->update_interval_session_by_detail_garage();
        }
        $this->read_neo_api = env('APP_READ_NEO_API',true);

        if($this->read_neo_api && $this->client){
            $records_api = $this->load_suggested_vehicles();
        }

        if($this->client && $records_api && $records_api->count()){
            $this->client_has_vehicles_with_downpayment = $this->client->has_vehicles_with_downpayment();
        }

    }

    public function render()
    {
         /** To Do
         * (1) Validar que la sesión no haya expirado de ser así enviar una vista con el informe.
        */


        if(!$this->client || !$this->allow_login){
            return view('livewire.suggested_vehicles.client_not_exists');
        }
        $this->get_garage();

        if ($this->garage && $this->show_garage ) {
             $this->read_vehicles_in_garage();
            return view('livewire.suggested_vehicles.vehicles');
        }

        if ($this->show_additional && $this->client_has_vehicles_with_downpayment) {
            $this->read_vehicles_additional();
        }else{
            $this->read_suggested_vehicles();
       }
        return view('livewire.show_vehicles.show-vehicles');
    }

    /** Vehículos sugeridos*/
    private function read_suggested_vehicles(){
        $this->header_page = 'Vehicles you are approved';
        $this->records = $this->read_suggested_vehicles_client_id($this->client->id,0);
    }

    /** Vehículos en el Garaje  */
    private function read_vehicles_in_garage(){

        $this->header_page = 'My Garage';
        $this->records = $this->garage->vehicles_in_garages()->get();

    }

    /** Vehículos Adicionales  */
    private function read_vehicles_additional(){
        $this->header_page = 'Vehicles you are Additional Payment';
        $this->records = $this->read_suggested_vehicles_whit_payment($this->client->id,$this->downpayment);
    }

    private function update_interval_session_by_detail_garage(){

            $this->get_garage();
            if($this->garage ){
                if($this->garage->occupied_spaces()){
                    $start_at = Carbon::now();
                    $expire_at = Carbon::now()->addMinutes($this->garage->occupied_spaces() * env('SESSION_INTERVAL') +env('SESSION_INTERVAL') );
                    $this->allow_login->start_at = $start_at;
                    $this->allow_login->expire_at = $expire_at;
                    $this->allow_login->save();
                }
                $this->review_garage();
            }

    }

    // Regresa a aprobados apagando indicadores
    public function return_to_approved(){
        $this->reset(['show_garage','show_additional']);
    }
}
