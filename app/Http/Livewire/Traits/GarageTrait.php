<?php

namespace App\Http\Livewire\Traits;

use App\Models\DetailGarage;
use App\Models\Garage;
use App\Models\Inventory;

trait GarageTrait {

    public $garage;
    public $garage_detail;

    /** Crea  Garage */
    public function create_garage(){
        $this->garage = Garage::create(['client_id' => $this->client_id]);
    }

    /** Lee Garage del cliente */
    public function get_garage(){
        $this->garage = Garage::ClientId($this->client->id)->first();
    }


    /*+-------------------------------------------------------------+
     *|             AGREGA VEHICULO AL GARAGE                       |
     *+-------------------------------------------------------------+
     *| Parámetros:                                                 |
     *| $stock = Id para buscar en el inventario y en el garaje     |
     *| $is_additional_next_tier: ¿Es de enganche adicional?        |
     *+-------------------------------------------------------------+
     *| Lógica del proceso                                          |
     *| 1.- Obtiene el garage                                       |
     *| 2.- Si no tiene garage el cliente se lo crea                |
     *| 3.- ¿En inventario y garage?: is_available_inventory = True |
     *| 4.- ¿Garage sin Inventario?: is_available_inventory = False |
     *| 5.- ¿Espacio en garage + inentario + NO en Garage           |
     *|      (A) Agrega el vehículo al garage                       |
     *|      (B) Muestra alerta                                     |
     *+-------------------------------------------------------------+
    */

    public function add_vehicle_to_garage($stock,$is_additional_next_tier=false){
        $this->get_garage();
        if(!$this->garage){
            $this->create_garage();
        }

        $inventory_record = Inventory::Stock($stock)->first();
        $garage_detail_record = DetailGarage::GarageId($this->garage->id)->Stock($stock)->first();

        if($garage_detail_record && !$inventory_record){
            $garage_detail_record->is_available_inventory = 0;
        }
        if($garage_detail_record && $inventory_record){
            $garage_detail_record->is_available_inventory = 1;
        }

        if($this->garage->has_space() && !$garage_detail_record && $inventory_record){
            if($this->create_detail_garage($inventory_record,$is_additional_next_tier)){
                $this->add_interval_to_client_session();
                $this->show_alert();
            };
        }
    }

    /*+-------------------------------------------------------------+
     *|      REVISA GARAGE SI LOS VEHÍCULOS ESTÁN EN INVENTARIO     |
     *+-------------------------------------------------------------+
     *| Parámetros:                                                 |
     *| Ninguno                                                     |
     *+-------------------------------------------------------------+
     *| Lógica del proceso                                          |
     *| 1.- Obtiene el garage                                       |
     *| 2.- Recorre los vehículos del garage x cada uno             |
     *|     (a) Busca en Inventario                                 |
     *|     (b) ¿Existe?                                            |
     *|         Si: $available = 1                                  |
     *|         No: $available = 0                                  |
     *|     (c) Actualiza is_available_inventory = $available       |
     *+-------------------------------------------------------------+
    */

    public function review_garage(){
        $this->get_garage();
        if($this->garage && $this->garage->vehicles_in_garages->count()){
            foreach($this->garage->vehicles_in_garages as $vehicle_in_garage){
                $inventory_record = Inventory::DealerId($vehicle_in_garage->dealer_id)
                                            ->Vin($vehicle_in_garage->vin)
                                            ->stock($vehicle_in_garage->stock)
                                            ->first();
                if($inventory_record){
                    $vehicle_in_garage->is_available_inventory = 1;
                }else{
                    $vehicle_in_garage->is_available_inventory = 0;
                }
                $vehicle_in_garage->save();
            }
        }

    }

    // Crea registro en detalle del garaje
    private function create_detail_garage($inventory_record,$is_additional_next_tier=0,$is_available_inventory=1){
        return DetailGarage::create([
            'garage_id'             => $this->garage->id,
            'dealer_id'             =>$inventory_record->dealer_id,
            'vin'                   =>$inventory_record->vin,
            'stock'                 =>$inventory_record->stock,
            'year'                  =>$inventory_record->year,
            'make'                  =>$inventory_record->make,
            'model'                 =>$inventory_record->model,
            'exterior_color'        =>$inventory_record->exterior_color,
            'interior_color'        =>$inventory_record->interior_color,
            'mileage'               =>$inventory_record->mileage,
            'transmission'          =>$inventory_record->transmission,
            'engine'                =>$inventory_record->engine,
            'retail_price'          =>$inventory_record->retail_price,
            'sales_price'           =>$inventory_record->sales_price,
            'options'               =>$inventory_record->options,
            'images'                =>$inventory_record->images,
            'last_updated'          =>$inventory_record->last_updated,
            'body'                  =>$inventory_record->body,
            'trim'                  =>$inventory_record->trim,
            'is_additional_next_tier'=>$is_additional_next_tier,
            'is_available_inventory' =>$is_available_inventory]);
    }

    // Muestra la alerta
    private function show_alert(){
        $this->garage_detail = DetailGarage::count();
        $this->dispatchBrowserEvent('alert',[
           'type'=>'warning',
           'message'=>"Detail Garage Created Successfully!!'.$this->garage_detail.'",
           'confirmButtonText' => "Yes",
           'cancelButtonText'  => "Cancel"
       ]);
       $this->emit('mount');
    }
}
