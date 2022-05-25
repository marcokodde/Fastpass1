<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Calculator extends Component
{

    public $cost                    = 0;
    public $downpayment             = 0;
    public $rate                    = 1.0;
    public $plazo                   = 36;
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
        } else {
            $this->ctc_downpayment = 0;
        }

        if ($this->cost && is_numeric($this->cost) && $this->cost > 0 && $this->downpayment && is_numeric($this->downpayment) && $this->downpayment > 0) {
            $this->amount = $this->cost - $this->downpayment;
        } else {
            $this->amount = 0;
        }

        if ($this->ctc_downpayment && is_numeric($this->ctc_downpayment) && $this->ctc_downpayment > 0 && $this->cost && is_numeric($this->cost) && $this->cost > 0) {
            if ($this->ctc_downpayment < $this->cost * 0.2) {
                $this->ctc_downpayment = $this->cost * 0.2;
            }
        } else {
            $this->ctc_downpayment = 0;
        }

        if ($this->rate && is_numeric($this->rate) && $this->rate > 0 && $this->cost && is_numeric($this->cost) && $this->cost > 0 && $this->downpayment && is_numeric($this->downpayment) && $this->downpayment > 0) {
            $this->amount = $this->cost - $this->downpayment;
        } else {
            $this->amount = 0;
        }

        if ($this->cost && is_numeric($this->cost) && $this->cost > 0 && $this->ctc_downpayment && is_numeric($this->ctc_downpayment) && $this->ctc_downpayment > 0) {
            $this->ctc_amount = $this->cost - $this->ctc_downpayment;
        } else {
            $this->ctc_amount = 0;
        }
        if ($this->rate && is_numeric($this->rate) && $this->rate > 0 && $this->plazo && is_numeric($this->plazo) && $this->plazo > 0 &&  $this->amount && is_numeric($this->amount) && $this->amount > 0) {
            $this->others_amount_by_month   = $this->pmt($this->rate,$this->plazo,$this->amount);
        } else {
            $this->others_amount_by_month = 0;
        }
        if ($this->others_amount_by_month && $this->plazo && is_numeric($this->plazo) && $this->plazo > 0) {
            $this->others_amount_total = $this->others_amount_by_month * $this->plazo;
        } else {
            $this->others_amount_total = 0;
        }

        $this->ctc_amount_by_month      = $this->pmt(0,36,$this->ctc_amount);
        $this->ctc_amount_total         = $this->ctc_amount_by_month * 36;
    }

    private function  pmt($rate=0, $plazo=36,$amount){
        if($rate == 0) return $amount/$plazo;
            return ($rate/100/12 * $amount)/(1 - pow(1 + $rate/100/12,($plazo * -1)));
    }

}
