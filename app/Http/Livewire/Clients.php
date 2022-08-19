<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Clients extends Component
{
    public $date_from,$date_to;

    // Monta datos iniciales
    public function mount(){
        $this->date_from= Carbon::now()->firstOfMonth()->format('Y-m-d');
        $this->date_to = Carbon::now()->format('Y-m-d');
    }


    // Busca y regresa datos al formulario
    public function render(){

        $date_from = new Carbon($this->date_from);
        $date_from   = $date_from->endOfDay();
        $date_to = new Carbon($this->date_to);
        $date_to   = $date_to->endOfDay();

        $records = Client::select('client_id', 'loggin_times', 'times_loggin','date_at', 'created_at')
                            ->whereBetween('created_at', [$this->date_from, $this->date_to])
                            ->get();

        return view('livewire.clients.clients', [
            'records' => $records,
        ]);

    }


}
