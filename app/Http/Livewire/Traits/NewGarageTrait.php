<?php

namespace App\Http\Livewire\Traits;

use App\Models\Client;
use App\Models\DetailGarage;
use App\Models\Garage;
use App\Models\Inventory;
use App\Models\SuggestedVehicle;

trait NewGarageTrait {

    public $garage;
    public $isOpen = 0;
    public $garage_detail;
    public $record_detail_garage;
    /** Crea  Garage */
    public function create_garage() {
        $this->garage = Garage::create(['client_id' => $this->client_id]);
    }

    /** Lee Garage del cliente */
    public function get_garage(Client $client) {
        return Garage::ClientId($client->client_id)->first();
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

        $this->get_garage($this->client);
        if (!$this->garage) {
            $this->create_garage();
        }

        $inventory_record = Inventory::Stock($stock)->first();
        if ($inventory_record) {
            $suggested_vehicle = SuggestedVehicle::ClientId($this->client->id)
                                                    ->InventoryId($inventory_record->id)
                                                    ->first();
        }

        if ($suggested_vehicle) {
            $is_additional_next_tier= $suggested_vehicle->is_addional_downpayment();
        } else {
            $is_additional_next_tier= $suggested_vehicle  = false;
        }

        $garage_detail_record = DetailGarage::GarageId($this->garage->id)->InventoryId($inventory_record->id)->first();
        if ($garage_detail_record) {
            $garage_detail_record->is_available_inventory = $inventory_record ? 1 : 0;
        }

        if ($this->garage->has_space() && !$garage_detail_record && $inventory_record) {
            if ($this->create_detail_garage($inventory_record,$is_additional_next_tier)) {
                $this->add_interval_to_client_session();
                if($this->garage->occupied_spaces()+1 == env('GARAGE_SPACES')) {
                    $this->isOpen = true;
                }
                $stock = Inventory::findOrFail($this->record_detail_garage->inventory_id);
                $this->send_note_api_vehicle($stock->stock);
                $this->show_alert();
            }
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
        $this->get_garage($this->client);
        if ($this->garage && $this->garage->vehicles_in_garages->count()) {
            foreach ($this->garage->vehicles_in_garages as $vehicle_in_garage) {
                $inventory_record = Inventory::DealerId($vehicle_in_garage->dealer_id)
                                            ->Vin($vehicle_in_garage->vin)
                                            ->stock($vehicle_in_garage->stock)
                                            ->first();
                if ($inventory_record) {
                    $vehicle_in_garage->is_available_inventory = 1;
                } else {
                    $vehicle_in_garage->is_available_inventory = 0;
                }
                $vehicle_in_garage->save();
            }
        }
    }

    // Crea registro en detalle del garaje
    private function create_detail_garage($inventory_record,$is_additional_next_tier=0,$is_available_inventory=1) {

        return $this->record_detail_garage = DetailGarage::create([
            'garage_id'             => $this->garage->id,
            'inventory_id'          =>$inventory_record->id,
            'sales_price'           =>$inventory_record->suggested_vehicles[0]['sale_price'],
            'is_additional_next_tier'=>$is_additional_next_tier,
            'is_available_inventory' =>$is_available_inventory]);
    }

    // Muestra la alerta
    private function show_alert() {
        $this->dispatchBrowserEvent('show_toast_vehicle_added');
    }

    public function openModal() {
		$this->isOpen = true;
	}

    public function closeModal() {
		$this->isOpen = false;
		//$this->resetInputFields();
		$this->resetErrorBag();
    	$this->resetValidation();
	}
}
