<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Clients extends Component
{
    public function render()
    {
        $records =DB::table('clients')
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->groupBy('date')
                    ->get();

    $records = Client::all();

    return view('livewire.clients', [
        'records' => $records,
    ]);

    }
}
