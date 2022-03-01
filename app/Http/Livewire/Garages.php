<?php

namespace App\Http\Livewire;

use App\Models\Garage;
use Livewire\Component;
use App\Models\DetailGarage;
use App\Http\Livewire\Traits\GarageTrait;
use RealRashid\SweetAlert\Facades\Alert;


class Garages extends Component
{
    use GarageTrait;

    public $garages;

    public function render()
    {
        $this->garages = DetailGarage::all();
        return view('livewire.garages.index');
        Alert::toast('Toast Message', 'Toast Type');
    }
}