<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;

class ResetClients extends Component
{
    public $client_id;
    public $client;

    protected $queryString = [];

    public function mount(){
        $this->client_id = '8I09dwlw9SjFktU3SHFgV0JlD';
    }

    public function render()
    {
        return view('livewire.reset_clients.index');
    }

    public function read_client(){

        if($this->client_id){
            $this->client = Client::ClientId($this->client_id)->first();
        }

    }

    // Elimina datos del cliente
    public function destroy(Client $client){
        $client->suggested_vehicles()->delete();
        $client->garages()->delete();
        $client->sessions()->delete();
        $client->delete();
    }

    public function updatingSearch(): void{
		$this->gotoPage(1);
	}
}
