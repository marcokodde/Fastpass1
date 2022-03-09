<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\ApiTrait;
use App\Models\Client;
use Livewire\Component;
use App\Http\Livewire\Traits\NewGarageTrait;
use App\Http\Livewire\Traits\NewSessionClientTrait;
use App\Http\Livewire\Traits\NewSuggestedVehiclesTrait;

class NewShowVehiclesController extends Component
{

    use NewSessionClientTrait;
    use NewGarageTrait;
    use NewSuggestedVehiclesTrait;
    use ApiTrait;


    public $client_id;
    public $token;
    public $client;
    public $active_session=null;
    public $garage;
    public $client_has_vehicles_with_downpayment=false;
    // Variables para la vista
    public $records;
    public $header_page;
    public $show_garage=false;
    public $show_additional=false;
    public $show_approved = true;
    public $downpayment = 250;
    public $downpayment_ranges = [];
    public $view_to_show = null;


    /**+----------------------------------------+
     * | LO QUE DEBE HACER ESTE CONTROLADOR     |
     * +----------------------------------------+
     * | 1) Sesión                              |
     * | 2) Garage                              |
     * | 3) Regresar datos a la vista           |
     * +----------------------------------------+
  */

    public function mount($client_id,$token=null){
        $this->initial_review($client_id,$token);
    }

    public function render()
    {

        if(!$this->active_session){
            return view('livewire.new_show_vehicles.no_active_session');
        }


        $this->garage = $this->get_garage($this->client);


        if ($this->show_garage ) {
            $this->show_additional = false;
            $this->read_garage();
            $this->header_page = 'My Garage';
            $this->view_to_show = $this->view_to_show = 'livewire.new_show_vehicles.list_garage';
            return view('livewire.new_show_vehicles.index');
       }

       if ($this->show_additional && $this->client_has_vehicles_with_downpayment) {
           $this->show_garage = false;
           $this->read_additionals();
       }else{
           $this->read_approved();
      }


        // Vehículos Adicionales
        return view('livewire.new_show_vehicles.index');
    }


    /**+--------------------------------------------------------+
     * |                REVISION INICIAL                        |
     * +--------------------------------------------------------+
     * | 1) Gestiona Sesión                                     |
     * | 2) Lee Cliente                                         |
     * | 3) Si existe Cliente                                   |
     * |    (a) Actualza variables boolean                      |
     * |    (b) Lee la sesión activa                            |
     * |    (c) Si tiene sesión activa                          |
     * |        (i)  Lee el garage                              |
     * |        (ii) Actualiza la hora en que expira sesión     |
     * +--------------------------------------------------------+
    */

    private function initial_review($client_id,$token){
        $this->client_id = $client_id;
        $this->token = $token;
        $this->client = Client::ClientId($this->client_id)->first();
        if($this->client){

            $this->client_has_vehicles_with_downpayment = $this->client->has_vehicles_with_downpayment();
            $this->active_session = $this->manage_session($this->client,$token);
            if($this->active_session){
                $this->garage = $this->get_garage($this->client);
                $this->update_interval_session($this->active_session,$this->garage);
              //  $this->client->update_loggin_times();
            }
        }
    }


    /**+------------------------------------------------+
     * | Gestionar la Sesión                            |
     * +------------------------------------------------+
     * | 1) Cerrar las sesiones expiradas del cliente   |
     * | 2) ¿Es la primera vez que ingresa el cliente?  |
     * |    (Si) Crear la sesión del cliente            |
     * |    (No) Lee Sesión con cliente y token         |
     * +------------------------------------------------+
    */
    private function manage_session(Client $client,$token=null){
        $this->close_expired_sessions();

        // ¿Primera vez?: Crea la sesión
        if(!$client->loggin_times){
           return $this->create_client_session($client->id);
        };

        // Si no es la primera vez lee la sesión activa
        if($client->loggin_times){
            return $this->get_active_session_with_token($client->id,$token);
         }

    }


    /** Regresa para que se vean los vehículos aprobados */
    public function return_to_approved(){
        $this->reset(['show_garage','show_additional','show_approved']);
    }

    /** Vehículos Aprobados */
    private function read_approved(){
        $this->header_page = 'Vehicles you are approved';
        $this->view_to_show = 'livewire.new_show_vehicles.list_approved';
        $this->records = $this->read_approved_vehicles($this->client);

    }

    /** Vehículos en el Garaje  */
    private function read_garage(){
        $this->header_page = 'My Garage';
        $this->view_to_show = 'livewire.new_show_vehicles.list_garage';
        $this->garage = $this->get_garage($this->client);
        if($this->garage){
            $this->records = $this->garage->vehicles_in_garages()->get();
        }else{
            $this->records = null;
        }

        $this->show_additional = false;
    }

    /** Vehículos Adicionales  */
    private function read_additionals(){

        $this->header_page = 'Vehicles you are Additional Payment';
        $this->view_to_show = 'livewire.new_show_vehicles.list_additionals';
        $this->records = $this->read_vehicles_with_payment($this->client,$this->downpayment);
    }


}
