<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\SessionClientTrait;
use App\Models\Client;
use App\Models\ClientSession;
use Carbon\Carbon;
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

        $this->close_expired_sessions($this->client->id);

        $this->client_session = $this->get_active_session();

        if($this->client_session){
            $this->expire_at = new \Carbon\Carbon( $this->client_session->expire_at);
            $this->time_remainder=$this->expire_at->diffInMinutes(now());
            return view('livewire.time_remainder.time-remainder');
        }

        $this->client->update_loggin_times();
        $this->create_client_session(600,$this->create_client_token(),1);
        dd('Debe haber una sesion con token');
        return view('livewire.time_remainder.time-remainder-finish');
    }
}
