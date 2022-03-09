<?php

namespace App\Http\Livewire\Traits;

use App\Models\ClientSession;
use App\Models\Garage;
use Carbon\Carbon;


trait NewSessionClientTrait {

    /** Cierra Sesiones que estén caducas */
    private function close_expired_sessions(){
        $session_records = ClientSession::Expired()->get();
        foreach($session_records as $session_record){
            if($session_record->is_expired()){
                $session_record->delete();
            }
        }
    }

    /** Actualiza tiempo de sesión  según los espacios ocupados*/
    public function update_interval_session(ClientSession $client_session,Garage $garage=null){
        if($garage && $garage->occupied_spaces()){
            $expire_at = Carbon::now()->addMinutes($garage->occupied_spaces() * env('SESSION_INTERVAL') +env('SESSION_INTERVAL') );
        }else{
            $expire_at = Carbon::now()->addMinutes(env('SESSION_INTERVAL') );
        }

        $client_session->start_at = now();
        $client_session->expire_at = $expire_at;
        $client_session->save();
    }



    /** Revisamos el ingreso */
    private function allow_login(){
        if(!$this->client){
            return false;
        }

        if($this->client->loggin_times  && !$this->token){
            return false;
        }

        $session_record = $this->get_active_session();


        if(!$session_record && !$this->client->loggin_times){
            return $this->create_client_session();
        }

        if($session_record && $session_record->token){
            $session_record->start_at = Carbon::now();
            $session_record->expire_at = Carbon::now()->addMinutes(env('SESSION_INTERVAL'));
            $this->client->update_loggin_times();
            $session_record->save();
        }
        return  $session_record;
    }

    /** Crea la sesión  */
    private function create_client_session($minutes=null,$token=null,$generated_by_system=0){
        $minutes = !$minutes ? env('SESSION_INTERVAL') : $minutes;
        $start_at = Carbon::now();
        $expire_at = Carbon::now()->addMinutes($minutes);
        return ClientSession::create([
            'client_id' =>  $this->client->id,
            'token'     =>  $token,
            'start_at'  =>  $start_at,
            'expire_at' =>  $expire_at,
            'generated_by_system' => $generated_by_system,
            'active'    =>  1,
            ]
        );
    }

    /** Obtiene la sesión activa */
    private function get_active_session($client_id){
        return ClientSession::ClientId($client_id)->Active()->first();
    }

    // Lee sesión activa con cliente_id y Token
    public function get_active_session_with_token($client_id,$token){
        return ClientSession::ClientId($client_id)->Token($token)->Active()->first();
    }

   // public function inactive_session(){
        // $session_record = $this->get_active_session();
        // if($session_record){
        //     $session_record->active = 0;
        //     $session_record->save();
        // }
    //}

    // Agrega intervalo permitido a la sesión
    public function add_interval_to_client_session($minutes=null){
        if(!$minutes){
            $minutes = env('SESSION_INTERVAL',60);
        }
        $client_session = $this->get_active_session($this->client->id);
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
