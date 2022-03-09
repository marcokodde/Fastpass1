<div class="relative mt-12">
    @if (isset($record->garage) && $record->garage->count())
        <div class="vehicle shadow-2xl">
            @if($record->images)
                @php
                    $value = explode(",", $record->images);
                @endphp

                @if($value[0])
                    <div class="box_to_image" style="width:300px;">
                        <img src="{{ $value[0] }}" alt="{{ __('Not Image') }}">
                    </div>
                @else
                    <img class="h-44 w-44" src="{{ asset('images/default_image.png') }}" alt="">
                @endif
            @else
                @if($record->images)
                    <div class="box_to_image" style="width:300px;">
                        <img src="{{ $record->images }}" alt="{{ __('Not Image') }}">
                    </div>
                @else
                    <img class="h-44 w-44" src="{{ asset('images/default_image.png') }}" alt="">
                @endif
            @endif

            @if($record->vin || $record->make || $record->model )
                <label class="text-xl font-oswald text-black font-bold block">{{$record->year}} {{$record->make}} {{$record->model}}</label>
            @else
                <p>{{ __('No data available') }}</p>
            @endif

            @if($record->mileage)
                <label class="font-oswald  block">{{ number_format($record->mileage, 0, '.', ',') }} {{ __('MILES') }}</label>
            @else
                <p>{{__('Mileage data available') }}</p>
            @endif

            @if($record->stock)
                <label class="font-oswald  block">{{__('STOCK')}} {{ $record->stock }}</label>
            @else
                <p>{{__('No data available') }}</p>
            @endif
            @if($record->is_additional_next_tier)
                <h5 class="mt-2 font-bold text-red-600">{{__('Additional Down Payment') }}</h5>
            @endif
            <div class="mb-2">
                <!-- TO DO: Evaluar si ya existe el vehículo en el garage (Ver Historia) -->
                <button type="button" class="bg-gray-600 font-bold text-white px-8 pb-4 py-4 m-4 rounded relative border-2 border-gray-700 disabled" disabled>
                    {{__('IN MY GARAGE')}}
                </button>
            </div>
        </div>
    @else
        <div style="background-color:#5CB352;  height:500px;" class="w-full absolute">
            <div class="mx-auto">
                <div class="items-center text-center align-center">
                    <h2 class="mb-2 font-montserrat text-center text-white">
                        {{__('There are no vehicles in your garage')}}
                    </h2>
                    <label class="mb-2 font-oswald text-white text-xl">
                        {{__('Browse our inventory to add your next vehicle !!')}}
                    </label>
                    <div class="relative rounded-xl overflow-auto p-4">
                        <div class="relative rounded-lg text-center overflow-hidden w-56 sm:w-96 mx-auto">
                            <div class="absolute inset-0 opacity-50 bg-stripes-gray"></div>
                            <img class="relative z-10 object-scale-down h-72 w-full" src="{{asset('images/coche.png')}}">
                        </div>
                    </div>
                    <span class="mx-auto">
                        <button style="background-color:#E3C116" wire:click="return_to_approved"
                                class=" hover:bg-yellow-600 hover:text-black
                                    text-white text-2xl font-bold px-20 pb-4 py-4 rounded-lg">
                                    {{ __('SEE INVENTORY')}}
                        </button>
                    </span>
                </div>
            </div>
        </div>
    @endif
</div>