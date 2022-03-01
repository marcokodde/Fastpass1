<?php

namespace App\Http\Livewire;

use App\Models\Garage;
use Livewire\Component;
use App\Models\DetailGarage;
use App\Http\Livewire\Traits\GarageTrait;



class Garages extends Component
{
    use GarageTrait;

    public $garages;
    protected $listeners = ['mount'];

    public function mount() {
        $this->garages = DetailGarage::all();
    }

    public function render()
    {
        return view('livewire.garages.index');
    }
}