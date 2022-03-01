<div class="vehicle-listings">
    @foreach ($vehicles as $vehicle )
        <div class="vehicle">
            @if(explode(",", $vehicle['images'])[0])
                <div class="box_to_image">
                    <img src="{{explode(",", $vehicle['images'])[0] }}" alt="{{ __('Not Image') }}">
                </div>
            @else
                <img class="h-24 w-24 items-center align-center mx-auto" src="{{ asset('images/default.jpeg') }}" alt="">
            @endif

            @if($vehicle['vin'] || $vehicle['make'] || $vehicle['model'] )
                <label class="text-sm font-bold block">{{$vehicle['year']}} {{$vehicle['make']}} {{$vehicle['model']}}</label>
            @else
                <p>{{ __('No data available') }}</p>
            @endif

            @if($vehicle['mileage'])
                <label class="text-sm block">{{ number_format($vehicle['mileage'], 0, '.', ',') }} {{ __('MILES') }}</label>
            @else
                <p>{{__('No data available') }}</p>
            @endif

            @if($vehicle['stock'])
                <label class="text-sm block">{{__('STOCK')}} {{ $vehicle['stock'] }}</label>
            @else
                <p>{{__('No data available') }}</p>
            @endif

            <p>{{__('RETAIL PRICE')}}</p>
            @if($vehicle['retail_price'])
                <h3>{{ number_format($vehicle['retail_price'], 0, '.', ',') }} {{ __('Price') }}</h3>
            @else
                <h2 class="font-bold">{{__('$25,200') }}</h2>
            @endif
            <div class="mb-2">
                <button wire:click="add_vehicle_to_garage({{ $vehicle['id'] }})" type="button" class="bg-green-700 text-white px-2 m-4 rounded relative border-2 border-gray-700">
                    {{__('Add To Garage')}}
                </button>

                <button wire:click="hola()" type="button" class="bg-blue-700 text-white px-2 m-4 rounded relative border-2 border-gray-700">
                    {{__('Boton prueba')}}
                </button>
            </div>
        </div>
    @endforeach
</div>