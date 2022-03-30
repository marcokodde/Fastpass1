<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use App\Models\ClientSession;



use Illuminate\Support\Facades\Http;
use App\Http\Livewire\Traits\ApiTrait;
use GuzzleHttp\Exception\RequestException;
use App\Http\Livewire\Traits\NewSuggestedVehiclesTrait;

class WelcomeController extends Component
{

    use ApiTrait;
    use NewSuggestedVehiclesTrait;

   // protected $queryString = ['client_id','token'];
    public $client_id;
    public $client;
    public $token;
    public $right_params = false;
    public $response_neo_is_null = false;
    public $records;
    public $there_are_records_api=false;

    public function mount($client_id,$token=null){
        $this->client_id = $client_id;
        $this->token = $token;

        $this->right_params = $this->validate_params();


        if($this->client){
            $this->there_are_records_api = $this->load_suggested_vehicles();
            if($this->right_params){
                $this->client->update_times_loggin();
                $this->client->update_active_sessions();
            }
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

       return view('livewire.welcome.welcome-controller');
    }

    private function validate_params(){

        if(!$this->client_id || empty($this->client_id) ){
            return false;
        }

        $this->client = $this->read_client();

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


    public function client_require_new_code(Client $client) {
        $url_to_new_code = 'https://newfastpass.com/' . $client->client_id . '/' . $client->session_with_token()->token;
        try {
            $response = Http::withHeaders([
                'Connection' => 'keep-alive',
                'Access-Token' => 'dRfgmuyehzDmagMcz62wrRiqa',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'])
            ->post('https://api.neoverify.com/v1/add_note/', [
                        'neo_id'    =>  $this->client_id,
                        'note'      =>  ' Client Requested New Code: Here is the New Code for you: ' . $url_to_new_code
                    ]);
            return $response->json();
        } catch (RequestException $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

}
