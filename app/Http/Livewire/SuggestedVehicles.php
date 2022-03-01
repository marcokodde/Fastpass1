<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\ApiTrait;
use App\Http\Livewire\Traits\GarageTrait;
use App\Http\Livewire\Traits\SessionClientTrait;
use Livewire\Component;

class SuggestedVehicles extends Component
{

    use SessionClientTrait;
    use GarageTrait;
    use ApiTrait;


    public $client_id;
    protected $queryString = ['client_id'];
    public $suggested_vehicles, $records;
    public $allow_login;

    public function mount(){
        $this->close_expired_sessions();
        $this->allow_login = $this->allow_login();
        $this->get_garage();

    }

    public function render()
    {
        /** To Do
         * (1) Validar que la sesión no haya expirado de ser así enviar una vista con el informe.
        */

        $this->read_vehicles();
        return view('livewire.suggested_vehicles.vehicles');
    }

    public function ok() { dd("okokoko");}
}
