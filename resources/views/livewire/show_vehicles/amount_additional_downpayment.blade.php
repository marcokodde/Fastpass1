
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="grid items-center justify-center mx-auto">
        <label class="block mx-auto text-center font-oswald text-xl font-semibold">
            {{ __('Additional Down Payment') }}
            <div class="col-md-6">
                <input type="radio" wire:model.lazy="downpayment" id="250" value="250" >    <label class="sm:text-xs md:text-base 2xl:text-xl" >250</label>
                <input type="radio" wire:model.lazy="downpayment" id="500" value="500" >    <label class="sm:text-xs md:text-base 2xl:text-xl" >500</label>
                <input type="radio" wire:model.lazy="downpayment" id="750" value="750" >    <label class="sm:text-xs md:text-base 2xl:text-xl" >750</label>
                <input type="radio" wire:model.lazy="downpayment" id="1000" value="1000" >  <label class="sm:text-xs md:text-base 2xl:text-xl" >1000</label>
                <input type="radio" wire:model.lazy="downpayment" id="1250" value="1250" >  <label class="sm:text-xs md:text-base 2xl:text-xl" >1250</label>
                <input type="radio" wire:model.lazy="downpayment" id="1500" value="1500" >  <label class="sm:text-xs md:text-base 2xl:text-xl" >1500</label>
                <input type="radio" wire:model.lazy="downpayment" id="1750" value="1750" >  <label class="sm:text-xs md:text-base 2xl:text-xl" >1750</label>
                <input type="radio" wire:model.lazy="downpayment" id="2000" value="2000" >  <label class="sm:text-xs md:text-base 2xl:text-xl" >2000</label>
                <hr class="border-2 border-gray-300">
            </div>
        </label>
    </div>
    <div class="mx-auto block items-center align-center bg-gray-300">
        {{--  @foreach($downpayment_ranges as $downpayment_range)
            <input type="radio"
            wire:model.lazy="downpayment"
            min="{{env('APP_TO_PAYMENT_MIN',2000)}}"
            max="{{env('APP_TO_PAYMENT_MAX',2000)}}"
            step="{{env('APP_TO_PAYMENT_RANGE',2000)}}"
            class="border h-5 w-5 text-pink-600"
            value="{{$downpayment_range->id}}">
            <label class="inline text-base text-center font-semibold">{{$downpayment_range}}</label>
        @endforeach  --}}
    </div>
