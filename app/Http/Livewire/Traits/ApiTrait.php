<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Facades\Http;

trait ApiTrait {

    private $api_url= 'https://api.neoverify.com/v1/get_recommended_inventory?id=';
    private $api_inventory = 'http://c2c.teamkodde.com/api/inventory/';

    /** Lee los vehículos */
    private function read_vehicles(){
        $this->records = $this->read_api_suggested_vehicles();
        $this->read_inventory_vehicles($this->records);
        if($this->garage){
            $this->review_garage();
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

    //** Lee inventario de vehículos sugeridos que cumplen con el criterio */
    private function read_inventory_vehicles($records){
        $this->vehicles=[];
        foreach($records as $record){
            if($record['grade'] == 'A'){
                $inventory_record = $this->read_inventory_stock($record['stock']);
                if($inventory_record){
                    array_push($this->vehicles,$inventory_record);
                }
            }

        }
    }

    /** Lee registro de auto en inventario */
    private function read_inventory_stock($stock){
        $url_inventory = $this->api_inventory.$stock;
        return json_decode(HTTP::get($url_inventory),true);
    }

}
