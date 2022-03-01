<?php

namespace App\Http\Livewire;

use App\Models\ClientSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SuggestedVehicles extends Component
{

    private $api_url= 'https://api.neoverify.com/v1/get_recommended_inventory?id=';

    public $client_id;
    protected $queryString = ['client_id'];
    public $suggested_vehicles, $records;
    public $allow_login;

    public function mount(){
        $this->close_expired_sessions();
        $this->allow_login = $this->allow_login();
    }

    public function render()
    {

        $this->read_vehicles();
        return view('livewire.suggested_vehicles.vehicles');
    }

    /** Lee los vehículos */
    private function read_vehicles(){
        $this->records = $this->read_api_suggested_vehicles();
        $this->read_inventory_vehicles($this->records);
    }

    //** Lee inventario de vehículos sugeridos que cumplen con el criterio */
    private function read_inventory_vehicles($records){
        $this->vehicles=[];
        foreach($records as $record){
            if($record['grade']== 'A'){
                $url_inventory = 'http://c2c.teamkodde.com/api/inventory/'. $record['stock'];
                $inventory_record = json_decode(HTTP::get($url_inventory),true);
                if($inventory_record){
                    array_push($this->vehicles,$inventory_record);
                }
            }
        }

    }

    // Lee vehículos sugerios por NEO
    private function read_api_suggested_vehicles(){
        return json_decode(Http::withHeaders([
            'Connection' => 'keep-alive',
            'Access-Token' => 'dRfgmuyehzDmagMcz62wrRiqa',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->get($this->api_url . $this->client_id) ,true);
    }

    /** Cierra Sesiones que estén caducas */
    private function close_expired_sessions(){
        $session_records = ClientSession::ClientId($this->client_id)->Active()->get();
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
        $session_record = ClientSession::ClientId($this->client_id)->Active()->first();
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
    /** Agregamos al Garage */
    public function hola() {
        dd("Vientos");
        
    }
}
