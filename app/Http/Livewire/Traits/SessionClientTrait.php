<?php

namespace App\Http\Livewire\Traits;

use App\Models\Client;
use App\Models\ClientSession;
use Carbon\Carbon;

trait SessionClientTrait {

    /** Cierra Sesiones que estén caducas */
    private function close_expired_sessions(){
        $session_records = ClientSession::ClientId($this->client_id)
                                        ->where('expire_at','<',now())
                                        ->Active()
                                        ->get();
        if($session_records->count()){
            foreach($session_records as $session_record){
                if(Carbon::now()->diffInMinutes($session_record->start_at) >= env('SESSION_INTERVAL')){
                    $session_record->active = 0;
                    $session_record->save();
                }
            }
        }
    }

    /** Revisamos el ingreso */
    private function allow_login(){

        $client_id = Client::ClientId($this->client_id)->first();
        if(!$client_id){
            Client::create(['client_id' => $this->client_id]);
        }

        $session_record = $this->get_active_session();
        if(!$session_record){
            $start_at = Carbon::now();
            $expire_at = Carbon::now()->addMinutes(env('SESSION_INTERVAL'));
            $session_record = ClientSession::create([
                'client_id' =>  $this->client_id,
                'start_at'  =>  $start_at,
                'expire_at' =>  $expire_at,
                'active'    =>  1
                ]
            );

        }
        return  $session_record;
    }

    /** Obtiene la sesión activa */
    private function get_active_session(){
        return ClientSession::ClientId($this->client_id)->Active()->first();
    }


    public function inactive_session(){
        $session_record = $this->get_active_session();
        if($session_record){
            $session_record->active = 0;
            $session_record->save();
        }

    }

}
