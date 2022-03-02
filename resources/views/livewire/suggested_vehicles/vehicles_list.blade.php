<div class="vehicle-listings">
    @foreach ($records as $record )
        <div class="vehicle">
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

            @if($record->inventory->vin || $record->inventory->make || $record->inventory->model )
                <label class="text-sm font-bold block">{{$record->inventory->year}} {{$record->inventory->make}} {{$record->inventory->model}}</label>
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

            <p>{{__('RETAIL PRICE')}}</p>
            @if($record->inventory->retail_price)
                <h3>{{ number_format($record->inventory->retail_price, 0, '.', ',') }} {{ __('Price') }}</h3>
            @else
                <h2 class="font-bold">{{__('$25,200') }}</h2>
            @endif
            <div class="mb-2">
                <!-- TO DO: Evaluar si ya existe el vehículo en el garage (Ver Historia) -->
                <button wire:click="add_vehicle_to_garage({{ "'". $record->inventory->stock  . "'"}})" type="button" class="bg-green-700 text-white px-2 m-4 rounded relative border-2 border-gray-700">
                    {{__('Add To Garage')}}
                </button>

            </div>
        </div>
    @endforeach
</div>
