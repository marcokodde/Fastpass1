<?php

namespace App\Http\Livewire\Traits;

use App\Models\DetailGarage;
use App\Models\Garage;

trait GarageTrait {

    public $garage;
    public $garage_detail;

    /** Crea  Garage */
    public function create_garage(){
        $this->garage = Garage::create(['client_id' => $this->client_id]);
    }

    /** Lee Garage del cliente */
    public function get_garage(){
        $this->garage = Garage::ClientId($this->client_id)->first();
    }

    /** Agrega vehículo al garage  */
    public function add_vehicle_to_garage($stock){
        $this->get_garage();
        if(!$this->garage){
            $this->create_garage();
        }

        if($this->garage->has_space()){
            DetailGarage::create(['garage_id' => $this->garage->id,'stock' => $stock]);
            $this->garage_detail = DetailGarage::count();
             // Set Flash Message
             $this->dispatchBrowserEvent('alert',[
                'type'=>'warning',
                'message'=>"Detail Garage Created Successfully!!'.$this->garage_detail.'",
                'confirmButtonText' => "Yes",
                'cancelButtonText'  => "Cancel"
            ]);
        }
        $this->emit('mount');
    }

    /** Revisa el garage para ver si los vehículos siguen estando en inventario */
    public function review_garage(){
        foreach($this->garage->vehicles_in_garages as $vehicle_in_garage){
            $inventory_record = $this->read_inventory_stock($vehicle_in_garage->stock);
            if(!$inventory_record){
                $vehicle_in_garage->delete();
            }
        }
    }

}
