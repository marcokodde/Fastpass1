<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\TemporaryInventory;
use Illuminate\Support\Facades\Http;

class InventoryController extends Controller
{

    private $api_inventory = 'http://c2c.teamkodde.com/api/inventory/read/all_inventory';

    public  function update_inventory(){
        $inventory_records =  json_decode(Http::get($this->api_inventory),true);
        if($inventory_records){
            TemporaryInventory::truncate();
            foreach($inventory_records as $inventory_record){
                $this->update_or_create_local_inventory($inventory_record);
                $this->create_temporary_inventory($inventory_record);
            }
            $this->update_sold_out_local_inventory();
            return "El inventario ha sido actualizado";
        }else{
            return 'Ho se leyeron registros de inventario';
        }


    }


    /** Actualiza registro en inventario Local */
    private function update_or_create_local_inventory($inventory_record){
        $local_inventory = Inventory::DealerId($inventory_record['dealer_id'])
                                    ->Vin($inventory_record['vin'])
                                    ->Stock( $inventory_record['stock'])
                                    ->first();

        $available = !$inventory_record['images'] || is_null($inventory_record['images']) || strlen($inventory_record['images']) < 5 ? false : true;
        // if(!$inventory_record['images'] || is_null($inventory_record['images']) || strlen($inventory_record['images']) < 5){
        //     $available = false;
        // }

        if($local_inventory && !$available){
            $images = $local_inventory->images;
        }else{
            $images = $inventory_record['images'];
        }

        $id_local_inventory = $local_inventory ? $local_inventory->id : null;

        Inventory::updateOrCreate(
            ['id' => $id_local_inventory],
            [
                'dealer_id'         => $inventory_record['dealer_id'],
                'vin'               => $inventory_record['vin'],
                'stock'             => $inventory_record['stock'],
                'year'              => $inventory_record['year'],
                'make'              => $inventory_record['make'],
                'model'             => $inventory_record['model'],
                'exterior_color'    => $inventory_record['exterior_color'],
                'interior_color'    => $inventory_record['interior_color'],
                'mileage'           => $inventory_record['mileage'],
                'transmission'      => $inventory_record['transmission'],
                'engine'            => $inventory_record['engine'],
                'retail_price'      => $inventory_record['retail_price'],
                'sales_price'       => $inventory_record['sales_price'],
                'options'           => $inventory_record['options'],
                'images'            => $images,
                'last_updated'      => $inventory_record['last_updated'],
                'body'              => $inventory_record['body'],
                'trim'              => $inventory_record['trim'],
                'available'         => $available
            ]
        );
    }

    /** Crea registro en inventario Local */
    private function create_temporary_inventory($inventory_record){
        TemporaryInventory::create([
            'dealer_id'         => $inventory_record['dealer_id'],
            'vin'               => $inventory_record['vin'],
            'stock'             => $inventory_record['stock'],
            'year'              => $inventory_record['year'],
            'make'              => $inventory_record['make'],
            'model'             => $inventory_record['model'],
            'exterior_color'    => $inventory_record['exterior_color'],
            'interior_color'    => $inventory_record['interior_color'],
            'mileage'           => $inventory_record['mileage'],
            'transmission'      => $inventory_record['transmission'],
            'engine'            => $inventory_record['engine'],
            'retail_price'      => $inventory_record['retail_price'],
            'sales_price'       => $inventory_record['sales_price'],
            'options'           => $inventory_record['options'],
            'images'            => $inventory_record['images'],
            'last_updated'      => $inventory_record['last_updated'],
            'body'              => $inventory_record['body'],
            'trim'              => $inventory_record['trim'],
           ]);
    }



    /**+----------------------------------------+
     * | ESTA VENDIDO EN INVENTARIO LOCAL       |
     * +----------------------------------------+
     * | Recorrer todo inventario local         |
     * | Buscar en inventario remoto: ¿Existe?  |
     * | Si = No Vendido                        |
     * | No = Vendido                           |
     * +----------------------------------------+
     */

     private function update_sold_out_local_inventory(){
         $local_inventory_records = Inventory::all();
         foreach($local_inventory_records as $local_inventory_record){
             $temporary_inventory_record = TemporaryInventory::DealerId($local_inventory_record->dealer_id)
                                                        ->Vin($local_inventory_record->vin)
                                                        ->Stock( $local_inventory_record->stock)
                                                        ->first();

            $local_inventory_record->update_sold_out(!$temporary_inventory_record);
         }

     }

}
