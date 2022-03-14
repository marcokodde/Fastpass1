<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SuggestedVehicle;

class RangeSlider extends Component
{
    public $minimo=500;
    public $maximo=4000;
    public $downpayment = 500;
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
       $this->read_vehicles_with_payment();
       $this->show = true;
    }

      // Lee los registros sugeridos
      private function read_vehicles_with_payment(){

        $value = SuggestedVehicle::select('suggested_vehicles.*')
                    ->join('inventories', 'inventories.id', '=', 'suggested_vehicles.inventory_id')
                    ->where('suggested_vehicles.client_id',2)
                    ->whereBetween('suggested_vehicles.downpayment_for_next_tier',[$this->minimo,$this->maximo])
                    ->orderBy('inventories.retail_price')
                    ->get();
        dd($value);

    }

}
