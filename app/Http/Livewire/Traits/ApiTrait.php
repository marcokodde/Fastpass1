<?php

namespace App\Http\Livewire\Traits;


use App\Models\Client;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;

trait ApiTrait {

    private $api_url= 'https://api.neoverify.com/v1/get_recommended_inventory?id=';
    private $api_inventory = 'http://www.ctcinventory.com//api/inventory/';
    public $customer;

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
    private function send_note_api_vehicle($stock) {
        $this->customer = Client::Where('client_id',"=" ,$this->client_id)->get();
        foreach ($this->customer as $client) {
        }

        if ($client->date_at) {
            try {
                $response = Http::withHeaders([
                    'Connection' => 'keep-alive',
                    'Access-Token' => 'dRfgmuyehzDmagMcz62wrRiqa',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'])
                ->post('https://api.neoverify.net/v1/add_note/', [
                            'neo_id'    =>  $this->client_id,
                            'note'      =>  'The customer added an appointment, these are his data:: '.$this->customer->date_at.', and vehicle to his garage:  Stock#'.$stock->stock.'',
                            'note_type' =>  'Vehicle'
                        ]);
                return $response->json();
            } catch (RequestException $ex) {
                return response()->json(['error' => $ex->getMessage()], 500);
            }
        } else {
            try {
                $response = Http::withHeaders([
                    'Connection' => 'keep-alive',
                    'Access-Token' => 'dRfgmuyehzDmagMcz62wrRiqa',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'])
                ->post('https://api.neoverify.net/v1/add_note/', [
                            'neo_id'    =>  $this->client_id,
                            'note'      =>  'The customer added this vehicle to his garage:  Stock#'.$stock->stock.'',
                            'note_type' =>  'Vehicle'
                        ]);
                return $response->json();
            } catch (RequestException $ex) {
                return response()->json(['error' => $ex->getMessage()], 500);
            }
        }
    }

    private function send_note_api_expire($token) {
        try {
            $response = Http::withHeaders([
                'Connection' => 'keep-alive',
                'Access-Token' => 'dRfgmuyehzDmagMcz62wrRiqa',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'])
            ->post('https://api.neoverify.net/v1/add_note/', [
                        'neo_id'    =>  $this->client_id,
                        'note'      =>  'We are sorry your session expired, do not worry click this link to go back to your garage www.newfastpass.com/'.$this->client_id.'/'.$token.' ',
                    ]);
            return $response->json();
        } catch (RequestException $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
