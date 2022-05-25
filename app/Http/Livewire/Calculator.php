<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Calculator extends Component
{

    public $cost = 0;
    public $downpayment = 0;
    public $rate = 1.0;
    public $plazo =36;


    public $amount                  = 0;
    public $others_amount_by_month  = 0;
    public $others_amount_total     = 0;
    public $ctc_plazo               = 36;
    public $ctc_amount_by_month     = 0;
    public $ctc_amount_total        = 0;
    public $ctc_downpayment         = 0;
    public $ctc_amount              = 0;


    public function render()
    {
        return view('livewire.calculator.calculator');
    }


    public function calcular(){
        if ($this->cost && is_numeric($this->cost) && $this->cost > 0) {
            $this->ctc_downpayment = $this->cost * 0.2;
        }

        if ($this->downpayment && is_numeric($this->downpayment) && $this->downpayment > 0) {
            $this->amount = $this->cost - $this->downpayment;
        }

        if ($this->ctc_downpayment && is_numeric($this->ctc_downpayment) && $this->ctc_downpayment > 0) {
            if ($this->ctc_downpayment < $this->cost * 0.2) {
                $this->ctc_downpayment = $this->cost * 0.2;
            }
        }

        if ($this->rate && is_numeric($this->rate) && $this->rate > 0) {
            $this->amount = $this->cost - $this->downpayment;
        }
        if ($this->ctc_downpayment && is_numeric($this->ctc_downpayment) && $this->ctc_downpayment > 0) {
            $this->ctc_amount = $this->cost - $this->ctc_downpayment;
        }

        $this->others_amount_by_month   = $this->pmt($this->rate,$this->plazo,$this->amount);
        $this->others_amount_total      = $this->others_amount_by_month * $this->plazo;
        $this->ctc_amount_by_month      = $this->pmt(0,36,$this->ctc_amount);
        $this->ctc_amount_total         = $this->ctc_amount_by_month * 36;
    }

    private function  pmt($rate=0, $plazo=36,$amount){
        if($rate == 0) return $amount/$plazo;
            return ($rate/100/12 * $amount)/(1 - pow(1 + $rate/100/12,($plazo * -1)));
    }

}
