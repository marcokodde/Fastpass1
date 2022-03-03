<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="items-center">
        <label class="block text-center items-center text-2xl font-semibold text-red-600">{{__('UNLOCK MORE VEHICLES')}}</label>
        <span class="block mx-2 text-center items-center text-lg text-black font-semibold">
            {{__('We have more vehicles in our inventory that require an additional down payment. Click view vehicles to unlock the prices.')}}
        </span>
        <div class="flex items-center justify-center mt-4">
           {{ __('Amount to Additional Payment') }}
            <span>
                <input type="number"
                        wire:model="downpayment"
                        list="downpayments"
                        min="0"
                        max="{{env('APP_TO_PAYMENT_max',2000)}}"
                        step="{{env('APP_TO_PAYMENT_RANGE',2000)}}"
                        class="ml-10"
                >
            </span>
            <datalist id="downpayments">
                @foreach($downpayment_ranges as $downpayment_range)
                    <option value="{{$downpayment_range}}">
                @endforeach
            </datalist>
        </div>
    </div>
</div>
