<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Additionalvehicles extends Component
{
    public function render()
    {
        return <<<'blade'
            <div class="items-center">
                <label class="block text-center items-center text-2xl font-semibold text-red-600">{{__('UNLOCK MORE VEHICLES')}}</label>
                <span class="block mx-2 text-center items-center text-lg text-black font-semibold">
                    {{__('We have more vehicles in our inventory that require an additional down payment. Click view vehicles to unlock the prices.')}}
                </span>
                <div class="flex items-center justify-center mt-4">
                    AQUI EL CLIENTE INDICARÁ SU IMPORTE DE ENGACHE
                </div>
            </div>
        blade;
    }
}
