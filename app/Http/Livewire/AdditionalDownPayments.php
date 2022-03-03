<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdditionalDownPayments extends Component
{

    public $downpayment = 0;
    public $downpayment_ranges = [];

    public function mount(){
        $this->fill_mounts_to_downpayment();
        $this->downpayment = env('APP_TO_PAYMENT_MIN',250);
    }

    public function render()
    {
        return view('livewire.additional-down-payments');
    }

    public function fill_mounts_to_downpayment(){
        $this->downpayment_ranges=[];
        for ($i = env('APP_TO_PAYMENT_MIN',250); $i <= env('APP_TO_PAYMENT_MAX',2000); $i=$i + env('APP_TO_PAYMENT_RANGE',250) ) {
            array_push($this->downpayment_ranges,$i);
        }
    }



}
