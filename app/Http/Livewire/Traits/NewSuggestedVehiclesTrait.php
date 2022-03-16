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
    private function read_vehicles_with_payment(Client $client,$from=null,$to=null){
        if(!$from){
            $from = env('APP_ADDITIONAL_DOWNPAYMENT_MIN');
        }
        if(!$to){
            $to=env('APP_ADDITIONAL_DOWNPAYMENT_MAX');
        }

        if($from == env('APP_ADDITIONAL_DOWNPAYMENT_MIN')){
            $from = 1;
        }
        // Lee todos los registros y actualiza a false mostrar vehículo
        $records =SuggestedVehicle::ClientId($client->id)->where('downpayment_for_next_tier', '>',0)->get();
        foreach($records as $record){
            $record->update_show_like_additional();
        }

        // Recorre y en caso dado muestra los vehículos
        foreach($records as $record){
            $downpayment_total_min      = $client->downpayment + $from;
            $downpayment_total_max      = $client->downpayment + $to;
            $downpayment_min_vehicle    = intdiv($record->sale_price * $record->dealer->percentage,100);
            if($downpayment_min_vehicle >= $downpayment_total_min && $downpayment_min_vehicle <=$downpayment_total_max){
                //        dd('Precio=' .$record->sale_price . ' % dealer=' . $record->dealer->percentage .
                //         ' Enganche Mínimo=' . $downpayment_min_vehicle . ' Inicial=' .$client->downpayment .
                //         ' Desde=' . $from . ' Hasta=' . $to . ' Total Min=' . $downpayment_total_min  .
                //         ' Total Max=' .  $downpayment_total_max
                // );
                $record->update_show_like_additional(true);
            }

        }


        return SuggestedVehicle::ClientId($client->id)
                    ->where('show_like_additional',1)
                    ->orderby('sale_price')
                    ->get();

    }


    private function read_vehicles_with_payment_limits(Client $client,$from,$to){
        $records = SuggestedVehicle::ClientId($client->id)
                                ->wherebetween('downpayment_for_next_tier',[$from,$to])
                                ->orderby('downpayment_for_next_tier')
                                ->get();

        foreach($records as $record){
            $record->update_show_like_additional($client->downpayment,$from,$to);
        }

        return SuggestedVehicle::ClientId($client->id)
                                ->where('show_like_additional',1)
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
                'percentage' => $this->decide_dealer_percentage($record)
            ]);
        }
    }

    // Decidir el porcentaje del distribuidor
    private function decide_dealer_percentage($record){
        $dealer_percentages = array(
            'North Freeway' => 10.00,
            'Gulf Freeway'  => 10.00,
            '1960'          => 10.00,
            'Airline'       => 10.00,
            'Shields'       => 7.00,
            'I-240'         => 7.00,
            'Hub'           => 7.00,
        );

        if(array_key_exists($record['dealership'], $dealer_percentages)){
            return $dealer_percentages[$record['dealership']];
        }else{
            return env('APP_PERCENTAGE_DEALER',7.00);
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
                if ($record['sale_price'] == 0) {
                    $sales_price = $inventory_record->sales_price;
                } else {
                    $sales_price = $record['sale_price'];
                }
                if (!$suggested_vehicle_client) {
                    SuggestedVehicle::create([
                        'dealer_id'     => $dealer_record->id,
                        'client_id'     => $client_record->id,
                        'inventory_id'  => $inventory_record->id,
                        'sale_price'     => $sales_price,
                        'grade'         => $record['grade'],
                        'downpayment_for_next_tier' => $record['additionalDownpaymentForNextTier']
                    ]);
                }
            }
        }
    }
}
