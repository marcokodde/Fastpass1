<?php

namespace App\Http\Livewire\Traits;

use App\Models\Client;
use App\Models\ClientSession;
use Carbon\Carbon;

trait SessionClientTrait {

    /** Cierra Sesiones que estén caducas */
    private function close_expired_sessions(){
        $session_records = ClientSession::ClientId($this->client_id)->Active()->Expired()->get();
        foreach($session_records as $session_record){
            if($session_record->is_expired()){
                $session_record->expire_sesion();
            }
        }
    }

    /** Revisamos el ingreso */
    private function allow_login(){
        $session_record = $this->get_active_session();
        if(!$session_record){
           return $this-> create_client_session();
        }
        return  $session_record;
    }

    /** Crea la sesión  */
    private function create_client_session(){
        $start_at = Carbon::now();
        $expire_at = Carbon::now()->addMinutes(env('SESSION_INTERVAL'));
        return ClientSession::create([
            'client_id' =>  $this->client_id,
            'token'     =>  $this->token,
            'start_at'  =>  $start_at,
            'expire_at' =>  $expire_at,
            'active'    =>  1
            ]
        );
    }

    /** Obtiene la sesión activa */
    private function get_active_session(){
        return ClientSession::ClientId($this->client_id)->Token($this->token)->Active()->first();
    }


    public function inactive_session(){
        $session_record = $this->get_active_session();
        if($session_record){
            $session_record->active = 0;
            $session_record->save();
        }

    }

    // Agrega intervalo permitido a la sesión
    public function add_interval_to_client_session($minutes=null){
        if(!$minutes){
            $minutes = env('SESSION_INTERVAL',60);
        }

        $client_session = $this->get_active_session();
        $expire_at_before = new \Carbon\Carbon($client_session->expire_at);
        $expire_at = $expire_at_before->addMinutes($minutes);
        $client_session->expire_at = $expire_at;
        $client_session->save();
    }


    // Crea un token revisando que no exista para el mismo cliente
    public function create_client_token(){
        $continue = true;
        while ($continue) {
            $token = bin2hex(random_bytes(env('APP_LENGHT_TOKEN',25)));
            $session_records = ClientSession::ClientId($this->client_id)->Token($token)->Active(false)->get();
            $exists_token = false;
           foreach($session_records as $session_record){
               if($session_record->token != $token){
                   $exists_token = true;
               }
           }
           $continue = $exists_token;
        }
        return $token;
   }


}
