<?php

namespace App\Http\Livewire\Traits;

use App\Models\Client;
use App\Models\Inventory;
use App\Models\SuggestedVehicle;


trait NewSuggestedVehiclesTrait {

    // Lee vehículos aprobados
    private function read_approved_vehicles(Client $client){
        return SuggestedVehicle::select('suggested_vehicles.*')
                    ->join('inventories', 'inventories.id', '=', 'suggested_vehicles.inventory_id')
                    ->where('suggested_vehicles.client_id',$client->id)
                    ->where('downpayment_for_next_tier', 0)
                    ->orderBy('inventories.retail_price')
                    ->get();
    }


    // Lee los registros sugeridos
    private function read_vehicles_with_payment(Client $client){

        return SuggestedVehicle::select('suggested_vehicles.*')
                    ->join('inventories', 'inventories.id', '=', 'suggested_vehicles.inventory_id')
                    ->where('suggested_vehicles.client_id',$client->id)
                    ->where('suggested_vehicles.downpayment_for_next_tier', '<=', $this->downpayment)
                    ->where('suggested_vehicles.downpayment_for_next_tier', '>',0)
                    ->orderBy('inventories.retail_price')
                    ->get();

    }



    // Lee el registro de tabla CLIENTS
    private function read_client(){
        $this->client = Client::ClientId($this->client_id)->first();
        if(!$this->client){
            $records = $this->read_api_suggested_vehicles();
            if($records && count($records) > 0){
                Client::create(['client_id' => $this->client_id]);
                $this->client = Client::ClientId($this->client_id)->first();
            }
        }

    }

    // Borra los vehículos sugeridos del cliente
    private function delete_suggested_vehicles_client($client_id){
        $suggested_vehicles_client = SuggestedVehicle::ClientId($client_id)->get();
        if($suggested_vehicles_client->count()){
            foreach($suggested_vehicles_client as $suggested_vehicle_client){
                $suggested_vehicle_client->delete();
            }
        }
    }

    /** Carga los vehículos */
    private function load_suggested_vehicles(){

        $records = $this->read_api_suggested_vehicles();

        if( is_null($records) || (isset($records['status']) &&  $records['status']== 500) ){
            $this->response_neo_is_null = true;
            return false;
        }


        if($records && count($records)){
            $this->delete_suggested_vehicles_client($this->client->id);               // Elimina vehículos sugeridos del cliente
            $this->create_suggested_vehicles_to_client($records,$this->client->id);   // Llena sugeridos del cliente desde inventario local
        }
    }


    // Pone autos sugeridos desde inventario local
    private function create_suggested_vehicles_to_client($records,$client_id){
        foreach($records as $record){
            $inventory_record = Inventory::Stock($record['stock'])->first();
            if($inventory_record){
                $suggested_vehicle_client = SuggestedVehicle::InventoryId($inventory_record->id)
                                                            ->ClientId($this->client->id)
                                                            ->first();
                if($inventory_record && $client_id && !$suggested_vehicle_client){
                    SuggestedVehicle::create([
                        'client_id'     => $client_id,
                        'inventory_id'  => $inventory_record->id,
                        'grade'         => $record['grade'],
                        'downpayment_for_next_tier' => $record['additionalDownpaymentForNextTier']
                    ]);
                }
            }
        }
    }

}
