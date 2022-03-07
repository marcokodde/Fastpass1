<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\SessionClientTrait;
use App\Models\Client;

use Livewire\Component;

class TimeRemainder extends Component
{
    use SessionClientTrait;

    public $client_id;
    public $token;
    public $client_session;
    public $time_remainder;
    public $expire_at;
    public $client;
    protected $queryString = ['client_id','token'];


    public function render()
    {

        $this->client = Client::ClientId($this->client_id)->first();

        $this->close_expired_sessions();

        $this->client_session = $this->get_active_session();

        if($this->client_session){
            $this->expire_at = new \Carbon\Carbon( $this->client_session->expire_at);
            if(now() > $this->expire_at ){
                $this->create_new_session();
               return view('livewire.time_remainder.time-remainder-finish');
            }

            $this->time_remainder=$this->expire_at->diffInMinutes(now());
            return view('livewire.time_remainder.time-remainder');
        }
        return view('livewire.time_remainder.time-remainder');
        return view('livewire.time_remainder.time-remainder-finish');
    }

    private function create_new_session(){
            //TODO: Enviar nota Sesión expiró:
        // http://fastpass.test/suggested_vehicles?client_id=IvViysJTjUGmTcP20P7GflE26&&token=<Token>
        $this->client->update_loggin_times();
        $token= $this->create_client_token();
        $this->create_client_session(210000,$token,1);
        //TODO: Enviar nota Sesión expiró:
        // http://fastpass.test/suggested_vehicles?client_id=IvViysJTjUGmTcP20P7GflE26&&token=<Token>
        return view('livewire.time_remainder.time-remainder-finish');
    }
}
