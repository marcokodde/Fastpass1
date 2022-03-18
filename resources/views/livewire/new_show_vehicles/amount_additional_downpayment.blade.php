<div class="grid items-center justify-center mx-auto px-4">
    <label class="block mx-auto text-gray-600 text-center font-oswald text-xl font-semibold mb-4">
        {{ __('Please select the extra amount for your down payment.') }}
    </label>
    <div class="items-center">
        <div class="flex">
            <label class="font-oswald text-gray-700 font-bold ml-12">{{__('From:')}} ${{ $left_value}}</label>
            <label class="font-oswald text-gray-700 font-bold 2xl:ml-64 ml-40">{{__('To:')}} ${{ $right_value}}</label>
        </div>
        <div class="flex 2xl:w-4/5 w-72 mx-auto">
            <input type="range"  style="background-color: #6AB04C"
                wire:model.lazy="left_value"
                min="{{$left_mininum}}"
                max="{{ $left_maximum}}"
                step="{{env('APP_ADDITIONAL_DOWNPAYMENT_STEP',500)}}"
                wire:change="update_right_minimum"
            >

            <input type="range"  style="background-color: #6AB04C" class="-ml-4"
                wire:model.lazy="right_value"
                min="{{$right_minimum}}"
                max="{{ $right_maximum}}"
                step="{{env('APP_ADDITIONAL_DOWNPAYMENT_STEP',500)}}"
                wire:change="update_left_maximum"
            >
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