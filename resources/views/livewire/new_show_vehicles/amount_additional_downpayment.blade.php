<div class="grid items-center justify-center mx-auto px-4">
    <label class="block mx-auto text-gray-600 text-center font-oswald text-xl font-semibold mb-4">
        {{ __('Please select the extra amount for your down payment.') }}
    </label>
    <div class="col-md-6 mx-4 px-4 mb-4">
        <div class="items-center">
            <div class="flex overflow-x-auto space-x-5  justify-between">
                <label>{{ $left_value}}</label><label class="ml-30">{{ $right_value}}</label>
            </div>
            <div class="flex">
                <input type="range"
                        wire:model.lazy="left_value"
                        min="{{$left_mininum}}"
                        max="{{ $left_maximum}}"
                        step="{{env('APP_ADDITIONAL_DOWNPAYMENT_STEP',500)}}"
                        wire:change="update_right_minimum"
                >

                <input type="range"
                        wire:model.lazy="right_value"
                        min="{{$right_minimum}}"
                        max="{{ $right_maximum}}"
                        step="{{env('APP_ADDITIONAL_DOWNPAYMENT_STEP',500)}}"
                        wire:change="update_left_maximum"
                >
            </div>
        </div>
    </div>

    <br>


    <label class="block mx-auto text-red-500 text-center font-oswald text-xl font-semibold mb-4">
        @if($vehicles_in_range)
            {{ $vehicles_in_range . ' ' . __('Vehicles Available') }}
        @else
            {{  __(' No vehicles found') }}
        @endif
    </label>

</div>
