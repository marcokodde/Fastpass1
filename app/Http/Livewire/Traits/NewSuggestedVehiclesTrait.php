<?php

namespace App\Http\Livewire\Traits;

use App\Models\Client;
use App\Models\Dealer;
use App\Models\Inventory;
use App\Models\SuggestedVehicle;


trait NewSuggestedVehiclesTrait {

    // Lee vehículos aprobados
    private function read_approved_vehicles(Client $client){

        $this->update_all_show_like_additional_all($client);

        foreach($client->suggested_vehicles_approved as $record){
            $downpayment_min_vehicle    = intdiv($record->sale_price * $record->dealer->percentage,100);
            if($client->downpayment >= $downpayment_min_vehicle){
                $record->update_show_like_additional(true);
            }
        }

        return SuggestedVehicle::ClientId($client->id)->where('show_like_additional',1)->orderby('sale_price')->get();
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
            $from = 0;
        }
        // Lee todos los registros y actualiza a false mostrar vehículo

        $this->update_all_show_like_additional_all($client);

        // Recorre y en caso dado muestra los vehículos
        foreach($client->suggested_vehicles_with_downpayment as $record){

            $downpayment_total_min      = $client->downpayment + $from;
            $downpayment_total_max      = $client->downpayment + $to;

            $downpayment_min_vehicle    = intdiv($record->sale_price * $record->dealer->percentage,100);


            if( $client->downpayment >= $downpayment_min_vehicle ||
                ($downpayment_min_vehicle >= $downpayment_total_min && $downpayment_min_vehicle <=$downpayment_total_max)){
                       if($record->downpayment_for_next_tier >= $from && $record->downpayment_for_next_tier <= $to  ){
                        $record->update_show_like_additional(true);
                    }

            }

        }

        return SuggestedVehicle::ClientId($client->id)->where('show_like_additional',1)->orderby('sale_price')->get();

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
                'name'          => $record['dealership'],
                'percentage'    => $this->decide_dealer_percentage($record),
                'open_sunday'   => $this->decide_dealer_open_sunday($record),
                'hour_opening'  => $this->decide_dealer_hour_opening($record),
                'hour_closing'  => $this->decide_dealer_hour_closing($record)
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
            'Ride Room'     => 10.00,
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

    // Decidir si abre o no en domingo
    private function decide_dealer_open_sunday($record){
        $dealer_open_sundays = array(
            'North Freeway' => true,
            'Gulf Freeway'  => true,
            'Ride Room'     => true,
            '1960'          => true,
            'Airline'       => true,
            'Shields'       => false,
            'I-240'         => false,
            'Hub'           => false,
        );

        if(array_key_exists($record['dealership'], $dealer_open_sundays)){
            return $dealer_open_sundays[$record['dealership']];
        }else{
            return env('APP_DEALER_OPEN_SUNDAY',true);
        }
    }

    // Decide hora de apertura
    private function decide_dealer_hour_opening($record){
        $dealer_hour_openings = array(
            'North Freeway' => 10,
            'Gulf Freeway'  => 10,
            '1960'          => 10,
            'Airline'       => 10,
            'Ride Room'     => 10,
            'Shields'       => 9,
            'I-240'         => 9,
            'Hub'           => 9,
        );

        if(array_key_exists($record['dealership'], $dealer_hour_openings)){
            return $dealer_hour_openings[$record['dealership']];
        }else{
            return env('APP_DEALER_OPEN_SUNDAY',true);
        }
    }

    // Decide hora de cierre
    private function decide_dealer_hour_closing($record){
        $dealer_hour_closings = array(
            'North Freeway' => 19,
            'Gulf Freeway'  => 19,
            '1960'          => 19,
            'Airline'       => 19,
            'Ride Room'     => 19,
            'Shields'       => 18,
            'I-240'         => 18,
            'Hub'           => 18,
        );

        if(array_key_exists($record['dealership'], $dealer_hour_closings)){
            return $dealer_hour_closings[$record['dealership']];
        }else{
            return env('APP_DEALER_OPEN_SUNDAY',true);
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

    // Deshabilita like_show_like additional en todos los registros
    private function update_all_show_like_additional_all(Client $client){
            foreach($client->suggested_vehicles as $record){
                $record->update_show_like_additional();
            }
    }
}
