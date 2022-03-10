<?php

namespace App\Http\Livewire;

use App\Models\SuggestedVehicle;
use Livewire\Component;

class TestController extends Component
{
    public $downpayment=500;

    public function mount(){


    }
    public function render()
    {

       return view('livewire.test-controller');
    }


}
