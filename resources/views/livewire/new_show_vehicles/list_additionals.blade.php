<div class="vehicle">
    @if($record->inventory->images)
        @php
            $value = explode(",", $record->inventory->images);
        @endphp

        @if($value[0])
            <div class="box_to_image">
                <img src="{{ $value[0] }}" alt="{{ __('Not Image') }}">
            </div>
        @else
            <img class="h-44 w-44 items-center align-center mx-auto" src="{{ asset('images/default.jpeg') }}" alt="">
        @endif
    @else
        @if($record->images)
            <div class="box_to_image">
                <img src="{{ $record->images }}" alt="{{ __('Not Image') }}">
            </div>
        @else
            <img class="h-44 w-44 items-center align-center mx-auto" src="{{ asset('images/default.jpeg') }}" alt="">
        @endif
    @endif

    @if($record->inventory->vin || $record->inventory->make || $record->inventory->model )
        <label class="text-xl text-black font-oswald font-bold block">{{$record->inventory->year}} {{$record->inventory->make}} {{$record->inventory->model}}</label>
    @else
        <p>{{ __('No data available') }}</p>
    @endif

    @if($record->inventory->mileage)
        <label class="text-sm block">{{ number_format($record->inventory->mileage, 0, '.', ',') }} {{ __('MILES') }}</label>
    @else
        <p>{{__('No data available') }}</p>
    @endif

    @if($record->inventory->stock)
        <label class="text-sm block">{{__('STOCK')}} {{ $record->inventory->stock }}</label>
    @else
        <p>{{__('No data available') }}</p>
    @endif

    @if($record->inventory->retail_price)
        <h3 class="mt-2">{{ __('Price') }}: ${{ number_format($record->inventory->retail_price, 0, '.', ',') }}</h3>
    @else
        <h5 class="mt-2 font-bold">{{__('Price data not available') }}</h5>
    @endif

    @if($record->downpayment_for_next_tier > 0)
        <h5 class="mt-2 font-bold text-red-600">{{__('Additional Down Payment') }}</h5>
    @endif

    <div class="mb-2">
       @include('livewire.new_show_vehicles.button_to_add_vehicle')
    </div>

</div>
