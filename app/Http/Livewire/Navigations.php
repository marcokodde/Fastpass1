<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\URL;

class Navigations extends Component
{
    public function render()
    {
        return <<<'blade'
            <div class="ml-4">
                <img class="stnd skip-lazy dark-version" width="207" height="110" alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
            </div>
            <button class="bg-green-500 px-10 rounded relative mt-8 ml-4 border-2 border-gray-700">
                    <a href="{{ URL::previous(); }}" class="inline" title="Vehicles">
                        <label class="text-white font-roboto text-xs font-semibold leading-relaxed uppercase ">{{__("Vehicles")}}</label>
                    </a>
            </button>
        blade;
    }
}