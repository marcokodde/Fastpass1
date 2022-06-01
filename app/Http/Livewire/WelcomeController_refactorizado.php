<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use App\Models\ClientSession;



use Illuminate\Support\Facades\Http;
use App\Http\Livewire\Traits\ApiTrait;
use GuzzleHttp\Exception\RequestException;
use App\Http\Livewire\Traits\NewSuggestedVehiclesTrait;
use App\Models\History;

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
    public $attempts = 1;
    public $max_attemps = 2;

    public function mount($client_id,$token=null){
        $this->client_id = $client_id;
        $this->token = $token;
        $this->general_process();
    }

    public function render()
    {
        if ($this->right_params){
            return view('livewire.welcome.welcome-controller');
        }
        if (!$this->right_params && $this->client && $this->client->session_with_token() ){
            return view('livewire.welcome.welcome_request_new_code');

        }else{
            if ($this->client && $this->attempts < $this->max_attemps) {
                $this->reset_client_data();
                $this->general_process();
            }else{
                return view('livewire.welcome.welcome_error');
            }

        }

        return view('livewire.welcome.welcome_error');


    }

    private function general_process(){
        $this->attempts++;
        $this->right_params = $this->validate_params();

        if($this->client){
            $this->there_are_records_api = $this->load_suggested_vehicles();
            if($this->right_params){
                $this->client->update_times_loggin();
                $this->client->update_active_sessions();
            }
        }
    }

    private function validate_params(){

        if(!$this->client_id || empty($this->client_id) ){
            return false;
        }

        $this->client = $this->read_client(); // Si no está el cliente lo crea

        if(!$this->client){
            $this->client_created = false;
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
            dd($record_session);

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


    private function reset_data_client(){
        $client_to_delete = Client::where('client_id',$this->client_id)->first();
        $client_to_delete->suggested_vehicles()->delete();
        $client_to_delete->garages()->delete();
        $client_to_delete->sessions()->delete();
        $client_to_delete->delete();
    }

    private function create_history(){

    }
}
