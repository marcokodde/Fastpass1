<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Client;
use App\Models\Reason;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Livewire\WithPagination;

class ResetClients extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $record = null;

    public function mount()
    {
       // $this->authorize('hasaccess', 'reset.index');
        $this->manage_title = __('Reset Data Client ');
        $this->search_label = "Neo Client Id";
        $this->view_table = 'livewire.reset_clients.table';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->record = null;
        if(strlen($this->search )){
            $this->record = Client::ClientId($this->search)->first();

        }
        return view('livewire.reset_clients.index');
	}


    /*+---------------------------------+
	  | Elimina los datos del Cliente   |
	  +---------------------------------+
	 */
	public function destroy(Client $client) {
        $client->suggested_vehicles()->delete();
        $client->garages()->delete();
        $client->delete();
        $this->show_alert('success',__('The data has been deleted'));
        $this->reset(['search']);
    }
}

