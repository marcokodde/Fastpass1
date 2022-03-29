<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Dealer;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\SuggestedVehicle;
use App\Http\Livewire\Traits\ApiTrait;
use App\Http\Livewire\Traits\NewGarageTrait;
use App\Http\Livewire\Traits\NewSessionClientTrait;
use App\Http\Livewire\Traits\NewSuggestedVehiclesTrait;
use Carbon\Carbon;

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
    public $client_has_vehicles_approved = false;
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
    public $date_at;
    public $hour;
    public $hours_to_appointment = [];
    public $max_date_to_appointment;
    public $min_date_to_appointment;
    public $dates_to_appointment = [];
    public $dealer;

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
            return view('livewire.new_show_vehicles.no_active_session');
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
            $this->create_list_dates_and_hours_to_appointment();
            $this->client_has_vehicles_with_downpayment =   $this->client->has_vehicles_with_downpayment();
            $this->client_has_vehicles_approved         =   $this->client->has_vehicles_approved();
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
        $this->records = $this->read_approved_vehicles($this->client);
        if($this->records && $this->records->count()) {
            $this->header_page = 'RECOMMENDED VEHICLES';
            $this->header_second = 'Based on your information these are vehicles you are eligible to purchase.';
        } else {
            $this->header_page = 'You are approved';
            $this->header_second = 'However, you need to increase your down payment to view vehicles you are eligible to purchase.The options are endless, click SHOW ME MORE to view vehicles with extra down payment.';
        }
        $this->view_to_show = 'livewire.new_show_vehicles.list_approved';
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
        $this->records = $this->read_vehicles_with_payment($this->client,$this->left_value,$this->right_value);
        $this->vehicles_in_range  = $this->records->count() ? $this->records->count() : 0;
    }

    // Muestra vista de citas
    public function show_appointment() {
        $this->openModal();
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

    public function store_appointment() {
        $this->validate([
            'date_at'   => 'required',
            'hour'      => 'required'
        ]);

        $hh=substr($this->hour,0,2);
        $mm=substr($this->hour,3,2);
        $meridian = substr($this->hour,6,2);

        $hh = $meridian == 'PM' && $hh != 12 ? $hh+12 : $hh;

        $new_hour = $hh . ':' . $mm;
        $date =  $this->date_at.' ' . $new_hour;

        $client = Client::Where('client_id', $this->client_id)->update(['date_at'   => $date]);
        $this->send_note_appointment($client);
        $this->closeModal();
    }



    private function create_list_dates_and_hours_to_appointment(){
        $first_suggested = SuggestedVehicle::ClientId($this->client->id)->first();
        $this->dealer = Dealer::findOrFail($first_suggested->dealer->id);
        $this->date_at = date('Y-m-d');
        if(date('w') == 0 && !$this->dealer->open_sunday){
            $this->date_at=date('Y-m-d',strtotime('+1 day'));
        }
        $this->create_list_dates_to_appointment($this->dealer);
        $this->create_list_hours_to_appointment($this->dealer);
        $this->min_date_to_appointment = Carbon::now()->format('Y-m-d');
        $this->max_date_to_appointment = Carbon::now()->addDays(env('APP_MAX_DAYS_TO_DATE',2))->format('Y-m-d');
    }

    /**+--------------------------------------------------------------------+
     * |         CREA LISTA DE FECHAS PARA CITA                             |
     * +--------------------------------------------------------------------+
     * | Ciclo desde 0 hasta la cantidad de fechas configuradas             |
     * | Para cada iteración                                                |
     * | 1.- Crea la fecha                                                  |
     * | 2.- Si No es domingo o  distribuidor domingos agrega la fecha      |
     * +--------------------------------------------------------------------+
     */

    private function create_list_dates_to_appointment(Dealer $dealer){
        $this->reset(['dates_to_appointment']);
        for($i=0;$i<=env('APP_MAX_DAYS_TO_DATE',7);$i++){
            $day_of_week=date('w',strtotime("+$i day"));
            $fecha=date('Y-m-d',strtotime("+$i day"));
            if($day_of_week !=0 || $dealer->open_sunday){
                array_push($this->dates_to_appointment,$fecha);
            }
        }

    }

    /**+--------------------------------------------+
     * | Objetivo: Tener una lista de horas  HH:MM  |
     * +--------------------------------------------+
     * | HH: Desde: Si es hoy a partir de la hora   |
     * |            actual + 1                      |
     *       Si es otro día $dealer->hour_opening   |
     * |     Hasta=$dealer->hour_closing            |
     * | MM: Rangos de 15 minutos                   |
     * +--------------------------------------------+
     * Crear lista de horas  y minutos              |
     * |   HH= Desde que abre hasta que cierra      |
     * |       Dentro de cada hora ir 00-45         |
     * |  Si HH < 12 --> AM si no --> PM            |
     * +--------------------------------------------+
     */

    public function create_list_hours_to_appointment(Dealer $dealer){
        $this->reset(['hours_to_appointment']);
        $initial_hour = $dealer->hour_opening;
        if(date('Y-m-d') == $this->date_at){
            $initial_hour = intval(date('H')+1);
        }

        for($hour=$initial_hour;$hour<$dealer->hour_closing;$hour++){
            for($mm=0;$mm<=45;$mm=$mm+15){
                $am_pm = $hour < 12 ? 'AM' : 'PM';
                $hh  = $hour > 12 ? $hour-12 : $hour;
                array_push($this->hours_to_appointment,Str::padLeft($hh,2,"0") . ':' .  Str::padLeft($mm,2,"0"). ' ' . $am_pm);
            }
        }

    }
}
