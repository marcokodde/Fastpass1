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
    public $client_session;
    public $time_remainder;
    public $expire_at;

    protected $queryString = ['client_id'];


    public function render()
    {
        $this->close_expired_sessions();
        $this->client_session = $this->get_active_session();
        if($this->client_session){
            $this->expire_at = new \Carbon\Carbon( $this->client_session->expire_at);
            $this->time_remainder=$this->expire_at->diffInMinutes(now());
            return view('livewire.time_remainder.time-remainder');
        }
        return view('livewire.time_remainder.time-remainder-finish');
    }
}
