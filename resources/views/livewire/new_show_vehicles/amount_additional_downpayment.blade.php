<div class="grid items-center justify-center mx-auto px-4">
    <label class="block mx-auto text-gray-600 text-center font-oswald text-xl font-semibold mb-4">
        {{ __('Please select the extra amount for your down payment.') }}
    </label>
    <div class="col-md-6 mx-4 px-4 mb-4">
        <div class="items-center">
            <div class="flex">
                <label class="font-oswald text-gray-700 font-bold text-center"> ${{ $downpayment}}</label>
            </div>
            <div class="flex mx-auto border-2 border-gray-400">
                <input type="range" class="bg-red-500"
                        wire:model.lazy="downpayment"
                        min="500"
                        max="4000"
                        step="500"
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
