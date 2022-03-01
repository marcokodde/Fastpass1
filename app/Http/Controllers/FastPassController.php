<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FastPassController extends Controller
{
    private $api_url= 'https://api.neoverify.net/v1/get_recommended_inventory?id=';

    public function inventory_stock($stock) {
        $this->api_url.= $stock;
        $records =  json_decode(Http::withHeaders([
            'Connection' => 'keep-alive',
            'Access-Token' => 'dRfgmuyehzDmagMcz62wrRiqa',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->get($this->api_url) ,true);
        $vehicles=[];

        foreach ($records as $record) {
            if ($record['grade']== 'D') {
                $url_inventory = 'http://c2c.teamkodde.com/api/inventory/'. $record['stock'];
                $inventory_record = json_decode(HTTP::get($url_inventory),true);
                if ($inventory_record) {
                    array_push($vehicles,$inventory_record);
                }
            }
        }

        return view('vehicles.index',compact('records'));
       //return view('vehicles.vehicles',compact('vehicles'));
    }
}