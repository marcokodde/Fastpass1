<?php

namespace App\Http\Livewire\Traits;


use Illuminate\Support\Facades\Http;

trait ApiTrait {

    private $api_url= 'https://api.neoverify.com/v1/get_recommended_inventory?id=';
    private $api_inventory = 'http://c2c.teamkodde.com/api/inventory/';


    // Lee vehículos sugerios por NEO
    private function read_api_suggested_vehicles(){
        return json_decode(Http::withHeaders([
            'Connection' => 'keep-alive',
            'Access-Token' => 'dRfgmuyehzDmagMcz62wrRiqa',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->get($this->api_url . $this->client_id) ,true);
    }


    /** Lee registro de auto en inventario */
    private function read_inventory_stock($stock){
        $url_inventory = $this->api_inventory.$stock;
        return json_decode(HTTP::get($url_inventory),true);
    }

    /** Envio de API, cuando el usuario se expiro sesion o en su caso si le intereso un vehiculo */
    private function send_note_api() {
        try {
            $response = Http::withHeaders([
                'Connection' => 'keep-alive',
                'Access-Token' => 'dRfgmuyehzDmagMcz62wrRiqa',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'])
            ->post('https://api.neoverify.net/v1/add_note/', [
                        'neo_id'    =>  $this->client_id,
                        'note'      =>  'Testing Note Ahava',
                        'note_type' =>  'Vehicle'
                    ]);
            // dd($response->status());
            return $response->json();
        } catch (RequestException $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
