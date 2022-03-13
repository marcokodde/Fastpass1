<?php

namespace App\Http\Livewire\Traits;

use App\Models\Client;
use App\Models\Dealer;
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
        $records = $this->read_api_suggested_vehicles();
        if(!$records || is_null($records) || count($records)< 1 ){
            return false;
        }

        foreach ($records as $record) {
            $this->create_dealer($record);
            $this->update_or_create_client($this->client_id,$record);
        }

        return  $this->client = Client::ClientId($this->client_id)->first();

    }


    // Crea distribuidor
    private function create_dealer($record){
        $dealer = Dealer::Name(ucwords($record['dealership']))->first();
        if(!$dealer){
            Dealer::create([
                'name' => $record['dealership'],
                'percentage' => env('APP_PERCENTAGE_DEALER',7.00)
            ]);

        }
    }

    // Crea o actualiza Cliente
    private function update_or_create_client($client_id,$record){
        $this->client = Client::ClientId($client_id)->first();

        if($this->client){
            $this->client->downpayment = $record['downpayment'];
            $this->client->save();
        }else{
            Client::create([
                'client_id'     => $client_id,
                'downpayment'   => $record['downpayment'],
            ]);
        }

    }

    // Borra los vehículos sugeridos del cliente
    private function delete_suggested_vehicles_client($client_id){
        SuggestedVehicle::ClientId($client_id)->delete();
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
            $this->create_suggested_vehicles_to_client($records,$this->client->client_id);   // Llena sugeridos del cliente desde inventario local
        }
    }


    // Pone autos sugeridos desde inventario local
    private function create_suggested_vehicles_to_client($records,$client_id){
        foreach($records as $record){

            $dealer_record      = Dealer::Name(ucwords($record['dealership']))->first();
            $client_record      = Client::ClientId($client_id)->first();
            $inventory_record   = Inventory::Stock($record['stock'])->first();

            if($dealer_record && $client_record && $inventory_record ){
                $suggested_vehicle_client = SuggestedVehicle::DealerId($dealer_record->id)
                                                            ->InventoryId($inventory_record->id)
                                                            ->ClientId($client_record ->id)
                                                            ->first();

                if(!$suggested_vehicle_client ){
                    SuggestedVehicle::create([
                        'dealer_id'     => $dealer_record->id,
                        'client_id'     => $client_record->id,
                        'inventory_id'  => $inventory_record->id,
                        'saleprice'     => $record['sale_price'],
                        'grade'         => $record['grade'],
                        'downpayment_for_next_tier' => $record['additionalDownpaymentForNextTier']
                    ]);
                }
            }
        }
    }

}
