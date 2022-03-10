<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Http\Livewire\Traits\ApiTrait;

use App\Models\ClientSession;
use Livewire\Component;
    
class WelcomeController extends Component
{

    use ApiTrait;
    protected $queryString = ['client_id','token'];
    public $client_id;
    public $client;
    public $token;
    public $right_params = false;
    public $response_neo_is_null = false;
    public $records;
    public $there_are_records_api=false;

    public function mount(){

        $this->right_params = $this->validate_params();
        if($this->client){
            $this->there_are_records_api = $this->load_suggested_vehicles();
            // $this->client->update_read_vehicles_from_api();
        }
    }

    public function render()
    {
        if($this->there_are_records_api){
            dd('Si hay registros en la api para el cliente ' . $this->client_id);
        }

        if( $this->response_neo_is_null){
            dd('Respuesta de neo es nula');
        }

        if(!$this->right_params){
            return view('livewire.welcome-bad-params');
        }

        $this->records = $this->read_suggested_vehicles_client_id($this->client->id,0);

        return view('livewire.welcome-controller');
    }

    private function validate_params(){

        if(!$this->client_id || empty($this->client_id) ){
            return false;
        }

        $this->read_client();
        $this->client = Client::ClientId($this->client_id)->first();

        if(!$this->client){
            return false;
        }

        if(!$this->client->loggin_times && $this->token || $this->client->loggin_times && !$this->token){
            return false;
        }

        // No es la primera vez - trae token revisa que exista la sesión
        if($this->client->loggin_times && $this->token){
            $record_session = ClientSession::ClientId($this->client->id)
                                        ->Token($this->token)
                                        ->Active()
                                        ->first();
            if(!$record_session){
                return false;
            }
        }

        return true;
    }




}
