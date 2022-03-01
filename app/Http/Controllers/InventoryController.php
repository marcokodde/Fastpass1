<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Support\Facades\Http;

class InventoryController extends Controller
{

    private $api_inventory = 'http://c2c.teamkodde.com/api/inventory/read/all_inventory';

    public  function update_inventory(){
        $inventory_records =  json_decode(Http::get($this->api_inventory),true);
        if($inventory_records){
            Inventory::truncate();
            foreach($inventory_records as $inventory_record){
               Inventory::create([
                'dealer_id'         => $inventory_record['dealer_id'],
                'vin'               => $inventory_record['vin'],
                'stock'             => $inventory_record['stock'],
                'year'              => $inventory_record['year'],
                'make'              => $inventory_record['make'],
                'model'             => $inventory_record['model'],
                'exterior_color'    => $inventory_record['exterior_color'],
                'interior_color'    => $inventory_record['interior_color'],
                'mileage'            => $inventory_record['mileage'],
                'transmission'      => $inventory_record['transmission'],
                'engine'            => $inventory_record['engine'],
                'retail_price'       => $inventory_record['retail_price'],
                'sales_price'        => $inventory_record['sales_price'],
                'options'           => $inventory_record['options'],
                'images'             => $inventory_record['images'],
                'last_updated'      => $inventory_record['last_updated'],
                'body'              => $inventory_record['body'],
                'trim'              => $inventory_record['trim'],
               ]);
            }
            return "El inventario ha sido actualizado";
        }else{
            return 'Ho se leyeron registros de inventario';
        }


    }

}
