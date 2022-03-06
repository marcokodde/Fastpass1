<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="items-center">
        <div class="flex items-center justify-center mt-4">
           {{ __('Amount to Additional Payment') }}
            <span>
                <input type="number"
                        wire:model.lazy="downpayment"
                        list="downpayments"
                        min="{{env('APP_TO_PAYMENT_MIN',2000)}}"
                        max="{{env('APP_TO_PAYMENT_MAZ',2000)}}"
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
