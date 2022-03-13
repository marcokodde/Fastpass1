<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RangeSlider extends Component
{
    public $minimo=500;
    public $maximo=4000;
    private $show=false;
    protected $listeners = ['presentavalores' => 'desdeJs'];
    public function render()
    {
        if($this->show){
            //dd('Min=' . $this->minimo . ' Max=' . $this->maximo);
            $this->show = false;
        }

        return view('livewire.range-slider');
    }

    public function desdeJs($param){
       // dd($param['values'][0] . '-' . $param['values'][1]);
       $this->minimo=$param['values'][0];
       $this->maximo=$param['values'][1];
       $this->show = true;
    }

}
