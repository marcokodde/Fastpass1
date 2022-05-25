<?php

namespace App\Http\Livewire;

use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class Calculator extends Component
{

    public $cost                    = 0;
    public $downpayment             = 0;
    public $rate                    = 0;
    public $plazo                   = 1;

    public $amount                  = 0;
    public $others_amount_by_month  = 0;
    public $others_amount_total     = 0;
    public $ctc_plazo               = 36;
    public $ctc_amount_by_month     = 0;
    public $ctc_amount_total        = 0;
    public $ctc_downpayment         = 0;
    public $ctc_amount              = 0;
    public $errors                  = array();
    public $diference_plazo         = 0;


    public function mount(){
        $this->calcular();
    }
    // Manda a la vista
    public function render()
    {
        return view('livewire.calculator.calculator');
    }


    // Calcula valores
    public function calcular()
    {

        $this->validate_data();
        if (count($this->errors)) {
            return;
        }
        $this->reset_values();

        $this->amount                   = round($this->cost - $this->downpayment, 2);
        $this->ctc_downpayment          = round($this->cost * 0.2, 2);
        $this->ctc_amount               = round($this->cost - $this->ctc_downpayment, 2);
        $this->others_amount_by_month   = $this->pmt($this->rate, $this->plazo, $this->amount);
        $this->others_amount_total      = $this->others_amount_by_month * $this->plazo;
        $this->ctc_amount_by_month      = $this->pmt(0, 36, $this->ctc_amount);
        $this->ctc_amount_total         = $this->ctc_amount_by_month * $this->ctc_plazo;

        $this->diference_plazo  = $this->plazo > $this->ctc_plazo ? $this->plazo > $this->ctc_plazo : 0;
    }

    // Restaura valores 
    private function reset_values($reset_all = false)
    {
        if ($reset_all) {
            $this->reset(['cost', 'downpayment', 'rate', 'plazo']);
        }
        $this->reset([
            'amount', 
            'ctc_downpayment',
            'ctc_amount', 
            'others_amount_by_month', 
            'others_amount_total', 
            'ctc_amount_by_month', 
            'ctc_amount_total'
        ]);
    }

    // Valida que los datos base sean válidos
    private function validate_data()
    {
        $errors = [];

        // Costo Vehículo
        if (isEmpty($this->cost)) {
            array_push($errors, __('Cost is Empty'));
        }

        if (!is_numeric($this->cost)) {
            array_push($errors, __('Cost is not numeric'));
        }

        if ($this->cost < 0) {
            array_push($errors, __('Cost must be greater than 0'));
        }

        // Enganche
        if (isEmpty($this->downpayment)) {
            array_push($errors, __('Downpayment is Empty'));
        }

        if (!is_numeric($this->downpayment)) {
            array_push($errors, __('Downpayment is not numeric'));
        }

        if ($this->downpayment < 0) {
            array_push($errors, __('Downpayment must be greater than 0'));
        }

        // Tasa de interés
        if (isEmpty($this->rate)) {
            array_push($errors, __('Rate is Empty'));
        }

        if (!is_numeric($this->rate)) {
            array_push($errors, __('Rate is not numeric'));
        }

        if ($this->rate < 0) {
            array_push($errors, __('Rate  must be greater than 0'));
        }


        // Plazo
        if (isEmpty($this->plazo)) {
            array_push($errors, __('Months  is Empty'));
        }

        if (!is_numeric($this->plazo)) {
            array_push($errors, __('Months  is not numeric'));
        }

        if ($this->plazo < 10) {
            array_push($errors, __('Months  must be greater than 1'));
        }
    }

    // Calcula pago mensual functión pmt clásica
    private function  pmt($rate = 0, $plazo = 36, $amount)
    {
        if ($rate == 0) return $amount / $plazo;
        return ($rate / 100 / 12 * $amount) / (1 - pow(1 + $rate / 100 / 12, ($plazo * -1)));
    }
}
