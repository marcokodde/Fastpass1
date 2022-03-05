<div>
    @livewire('navigations')
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mx-2 border border-gray-300" hidden>
                <div><label class="text-2xl text-gray-700">{{__('Session Expired in')}}</label> <span id="time" class="text-2xl text-red-600 bg-yellow-400 rounded-lg">05:00</span> minutes!</div>
            </div>
            <div class="mx-2 border border-gray-300">
                <div>
                    @livewire('time-remainder')
                </div>
            </div>

            <div class="bg-white overflow-hidden sm:rounded-lg mt-2">
                <label class="block text-center items-center font-serif text-3xl mx-4 font-semibold text-black leading uppercase">
                    {{__($header_page)}}
                </label>
                @if ($garage && $garage->not_available_spaces())
                <label class="block text-center items-center font-serif text-2xl mx-4 font-semibold text-gray-600 leading ">
                    {{__('Your Garage is Full')}}
                </label>
                @endif
                <div class="body_container mt-2">
                    <div class="container">
                        <div class="row">
                            <div class="custom-vehicle-details">
                                <div class="vehicle-listings">
                                    @foreach ($records as $record )
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
                                    
                                        @if($record->inventory->retail_price)
                                            <h3 class="mt-2">{{ __('Price') }}: ${{ number_format($record->inventory->retail_price, 0, '.', ',') }}</h3>
                                        @else
                                            <h5 class="mt-2 font-bold">{{__('Price data not available') }}</h5>
                                        @endif
                                    
                                        @if($record->downpayment_for_next_tier > 0)
                                            <h5 class="mt-2 font-bold text-red-600">{{__('Additional Down Payment') }}</h5>
                                    
                                            <h6 class=" text-2xl font-semibold mt-2">{{ __('Payment') }}: ${{ number_format($record->downpayment_for_next_tier, 0, '.', ',') }}</h6>
                                        @endif
                                    
                                        <div class="mb-2">
                                            @if ($garage && !$garage->has_space() && !$garage->available_spaces() && $garage->is_vehicle_in_garage($record->inventory->stock))
                                                    <button disabled title="{{__('Vehicle Added')}}"
                                                    type="button" class="bg-gray-600 text-white px-2 m-4 rounded relative border-2 border-gray-200">
                                                    {{__('Added To Garage')}}
                                                </button>
                                            @elseif($garage && $garage->not_available_spaces())
                                                <button disabled title="{{__('Garage Full')}}"
                                                    type="button" class="bg-gray-600 text-white px-2 m-4 rounded relative border-2 border-gray-200">
                                                    {{__('Garage Full')}}
                                                </button>
                                            @elseif ($garage && $garage->is_vehicle_in_garage($record->inventory->stock))
                                                <button disabled title="{{__('Vehicle Added')}}"
                                                    type="button" class="bg-gray-600 text-white px-2 m-4 rounded relative border-2 border-gray-200">
                                                    {{__('Added To Garage')}}
                                                </button>
                                            @else
                                                <button wire:click="add_vehicle_to_garage({{ "'". $record->inventory->stock  . "'"}})"
                                                    type="button" class="bg-green-700 text-white px-2 m-4 rounded relative border-2 border-gray-700">
                                                    {{__('Add To Garage')}}
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</d>