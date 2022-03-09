<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\SessionClientTrait;
use App\Models\Client;
use App\Models\ClientSession;
use Illuminate\Support\Str;

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

        if($this->client){
            $this->close_expired_sessions($this->client);
            $this->client_session = $this->get_active_session($this->client);
        }else{
            $this->client_session = null;
        }


        if($this->client_session){
            $this->expire_at = new \Carbon\Carbon( $this->client_session->expire_at);
            if(now() > $this->expire_at ){
                $this->client_session->expire_session();
                $this->create_new_session();
               return view('livewire.time_remainder.time-remainder-finish');
            }
            $this->calculate_remainder_time();
            return view('livewire.time_remainder.time-remainder');
        }else{
            if($this->client && !$this->client->loggin_times){
                $this->create_client_session();
                $this->client->update_loggin_times();
            }else{
                return view('livewire.time_remainder.time-remainder-finish');
            }

        }
        return view('livewire.time_remainder.time-remainder');
    }


    /** Calcula el tiempo restante */
    private function calculate_remainder_time(){
        $hours = 0;
        $minutes  =0;
        $seconds = 0;
        $this->time_remainder=$this->expire_at->diffInSeconds(now());
        $this->time_remainder=$this->expire_at->diffInSeconds(now());
        if( $this->time_remainder){
            $hours = str::padLeft(intdiv($this->time_remainder, 3600),2,"0");
            $rested_seconds = $this->time_remainder % 3600;
            if($rested_seconds){
                $minutes =  str::padLeft(intdiv($rested_seconds, 60),2,"0");
                $seconds =  str::padLeft($rested_seconds % 60,2,"0");
            }
        }
        if($hours){
            $this->time_remainder = $hours .  ':' . $minutes . ':' . $seconds;
        }else{
            $this->time_remainder = $minutes . ':' . $seconds;
        }
    }
    /** Crea nueva sesion con token */
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
