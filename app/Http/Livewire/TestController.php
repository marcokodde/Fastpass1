<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestController extends Component
{
    public $saludo;
    public function render()
    {
        return view('livewire.test-controller');
    }

    public function saludo($nombre){
        dd($nombre);
        $this->saludo ='Hola ' . $nombre;
    }
}
