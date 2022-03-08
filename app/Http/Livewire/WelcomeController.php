<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Http\Livewire\Traits\ApiTrait;
use Livewire\Component;


class WelcomeController extends Component
{

    use ApiTrait;

    protected $queryString = ['client_id','token'];
    public $client_id;
    public $token;
    private $right_params = false;


    public function mount(){
        $this->right_params = $this->validate_params();
    }

    public function render()
    {
        if(!$this->right_params){
            return view('livewire.welcome-bad-params');
        }
        return view('livewire.welcome-controller');
    }

    private function validate_params(){

        if(!$this->client_id || empty($this->client_id) ){
            return false;
        }

        $client = Client::ClientId($this->client_id)->first();
        if(!$client){
            Client::create(['client_id' => $this->client_id]);
            return true;
        }

        if(!$this->client_id || ($client && (!$client->loggin_times && !$this->token || $client->loggin_times && $this->token))){
            return false;
        }

        return true;
    }


}
