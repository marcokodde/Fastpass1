<?php

namespace App\Http\Livewire\Traits;

use App\Models\Client;
use App\Models\Inventory;
use App\Models\SuggestedVehicle;


trait SuggestedVehiclesTrait {

    // Lee los registros sugeridos
    private function read_suggested_vehicles_client_id($client_id,$downPayment=0){
        return SuggestedVehicle::ClientId($client_id)
                                ->DownPayment($downPayment)
                                ->get();
    }

    // Lee el registro de tabla CLIENTS
    private function read_client_id(){
        return Client::ClientId($this->client_id)->first();
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

    // Pone autos sugeridos desde inventario local
    private function create_suggested_vehicles_to_client($records,$client_id){
        foreach($records as $record){
            $inventory_record = Inventory::Stock($record['stock'])->first();
            $suggested_vehicle_client = SuggestedVehicle::InventoryId($inventory_record->id)->first();
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
