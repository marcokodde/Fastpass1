<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\ApiTrait;
use App\Models\Client;
use Livewire\Component;
use App\Http\Livewire\Traits\NewGarageTrait;
use App\Http\Livewire\Traits\NewSessionClientTrait;
use App\Http\Livewire\Traits\NewSuggestedVehiclesTrait;
use App\Models\ClientSession;

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
    public $header_second;
    public $show_garage=false;
    public $show_additional=false;
    public $show_approved = true;
    public $downpayment = 500;
    public $downpayment_ranges = [];
    public $view_to_show = null;

    // Control de slider para monto de enganche adicional
    public $left_mininum;
    public $left_maximum;
    public $left_value;

    public $right_minimum;
    public $right_maximum;
    public $right_value;

    public $vehicles_in_range = 0;

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
        $this->initial_values_to_sliders();
    }

    public function render()
    {
        if ($this->client) {
            $this->close_expired_sessions($this->client);
        }

        if (!$this->client || !$this->active_session) {
            return view('livewire.new_show_vehicles.not_active_session');
        }

        $this->garage = $this->get_garage($this->client);

        /** Mostrar Garage */
        if ($this->show_garage) {
            $this->show_additional = false;
            $this->read_garage();
            $this->header_page = 'My Garage';
            $this->view_to_show = 'livewire.new_show_vehicles.list_garage';
            return view('livewire.new_show_vehicles.index');
        }

       /** Mostrar Adicionales o Aprobados */
        if ($this->show_additional && $this->client_has_vehicles_with_downpayment) {
            $this->show_garage = false;
            $this->read_additionals();
        } else {
            $this->read_approved();
        }
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

        if ($this->client) {
            $this->client_has_vehicles_with_downpayment = $this->client->has_vehicles_with_downpayment();
            $this->active_session = $this->manage_session($this->client,$token);

            if ($this->active_session) {
                if (!$this->active_session->has_been_used) {
                    $this->garage = $this->get_garage($this->client);
                    $this->update_interval_session($this->active_session,$this->garage);
                    $this->active_session->update_has_been_used();
                }
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
        if ($client->loggin_times && !$token) {
            return false;
        }
        // ¿Primera vez?: Crea la sesión
        if (!$client->loggin_times) {
            return $this->create_client_session($client->id);
        };

        // Si no es la primera vez lee la sesión activa
        if ($client->loggin_times) {
            return $this->get_active_session_with_token($client->id,$token);
        }
    }

    /** Regresa para que se vean los vehículos aprobados */
    public function return_to_approved(){
        $this->reset(['show_garage','show_additional','show_approved']);
    }

    /** Vehículos Aprobados */
    private function read_approved(){
        $this->header_page = 'APPROVED VEHICLES';
        $this->header_second = 'Based on your information these are vehicles you are eligible to purchase.';
        $this->view_to_show = 'livewire.new_show_vehicles.list_approved';
        $this->records = $this->read_approved_vehicles($this->client);
    }

    /** Vehículos en el Garaje  */
    private function read_garage(){
        $this->header_page = 'My Garage';
        $this->header_second ='';
        if ($this->garage) {
            $this->records = $this->garage->vehicles_in_garages()->get();
            $this->view_to_show = 'livewire.new_show_vehicles.list_garage';
        }
    }

    /** Vehículos Adicionales  */
    private function read_additionals(){
        $this->header_page = 'ADDITIONAL VEHICLES';
        $this->header_second ='These are vehicles you are eligible to purchase with additional down payment.';
        $this->view_to_show = 'livewire.new_show_vehicles.list_additionals';
        $this->records = $this->read_vehicles_with_payment($this->client);

        // dd('Min=' . $this->left_value . 'Max=' . $this->left_maximum ,$this->records);
        $this->vehicles_in_range  = $this->records->count() ? $this->records->count() : 0;
        //$this->vehicles_in_range  = 0;
    }

    /** Valores Iniciales de los sliders */
    private function initial_values_to_sliders(){
        $this->left_mininum    = env('APP_ADDITIONAL_DOWNPAYMENT_MIN',500);
        $this->left_maximum    = env('APP_ADDITIONAL_DOWNPAYMENT_MAX',4000) -env('APP_ADDITIONAL_DOWNPAYMENT_STEP',500);
        $this->left_value      = $this->left_mininum;
        $this->right_minimum   = $this->left_mininum + env('APP_ADDITIONAL_DOWNPAYMENT_STEP',500);
        $this->right_maximum   = env('APP_ADDITIONAL_DOWNPAYMENT_MAX',4000);
        $this->right_value     = $this->right_maximum;
    }
    /** Actualiza  valor MÍNIMO slider derecho*/
    public function update_right_minimum(){
        $this->right_minimum = $this->left_value + env('APP_ADDITIONAL_DOWNPAYMENT_STEP',500);
        $this->right_maximum = env('APP_ADDITIONAL_DOWNPAYMENT_MAX',4000);
        $this->downpayment = $this->left_value;
        $this->read_additionals();
    }
    /** Actualiza  valor MÁXIMO slider izquierdo*/
    public function update_left_maximum(){
        $this->left_maximum = $this->right_value -env('APP_ADDITIONAL_DOWNPAYMENT_STEP',500);
        $this->downpayment = $this->left_value;
        $this->read_additionals();
    }
}