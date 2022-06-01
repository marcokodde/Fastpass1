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
        $this->calculate();
    }

    // Manda a la vista
    public function render()
    {
        return view('livewire.calculator.calculator');
    }


    // Calcula valores
    public function calculate()
    {
        $this->errors = [];
        $this->validate_data();

        if (count($this->errors)) {
            $this->reset_values();
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

        $this->diference_plazo  = $this->plazo > $this->ctc_plazo ? $this->plazo - $this->ctc_plazo : 0;
    }

    /*+-------------------------------------+
      | reset_values(borrar parámetros?)    |
      +-------------------------------------+
     */
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

        $this->validate_field($this->cost,'Cost');
        $this->validate_field($this->downpayment,'downpayment');
        $this->validate_field($this->rate,'Rate');
        $this->validate_field($this->plazo,'Months',1);
    }

    /*+-----------------------------+
      | pmt(rate,plazo,importe)     |
      +-----------------------------+
     */
    private function  pmt($rate = 0, $plazo = 36, $amount): float
    {
        if ($rate == 0) return $amount / $plazo;
        return ($rate / 100 / 12 * $amount) / (1 - pow(1 + $rate / 100 / 12, ($plazo * -1)));
    }

    /*+---------------------------------------------------------+
      | Validate_fields(campo a validar,mensaje,valor mínimo)   |
      +---------------------------------------------------------+
     */
    private function validate_field($field,$message,$min=0){

        if (strlen($field) < 1) {
            array_push($this->errors, __($message) . ' ' . __('is Empty'));
        }

        if (!is_numeric($field))  array_push($this->errors, __($message) . ' ' . __('is not numeric'));

        if ($field < $min) {
            if($min == 0){
                array_push($this->errors, __($message) . ' ' .  __('must be greater than 0'));
            }else{
                array_push($this->errors, __($message) . ' ' .  __('must be greater than 1'));
            }
        }

    }

}
