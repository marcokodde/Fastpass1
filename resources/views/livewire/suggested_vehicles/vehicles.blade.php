<div>
    @include('livewire.suggested_vehicles.index')
    <div class="sidemenu mt-12 w-64 absolute">
        {{-- <div class="mb-2">
            <button class="bg-yellow-400 px-8 rounded relative mt-1 ml-4 mx-4 border-2 border-gray-700"
                    wire:click="set_show_garage"
                    >
                    <label class="text-black font-roboto text-xs font-semibold leading-relaxed uppercase ">
                        @if($show_garage)
                            {{__("Vehicles")}}
                        @else
                            {{__("My Garage")}}
                        @endif
                    </label>
            </button>
        </div> --}}

        {{-- @if ($garage == null)
                <h1 class="font-semibold text-lg font-serif text-center mt-4">{{__("You have")}}
                {{env('GARAGE_SPACES')}} {{__("spaces in your garage")}}
            </h1>
        @else
            @livewire('garages')
        @endif --}}

    </div>
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
                @if($garage)
                    <label class="block text-center items-center font-serif text-2xl mx-4 font-semibold text-gray-600 leading ">
                        @if($garage->has_space())
                            {{__('You have') . '   ' . $garage->available_spaces()  . '   '.  __('in your garage')}}
                         @else
                            {{__('Your Garage is Full')}}
                        @endif

                    </label>
                @endif
                <div class="body_container mt-2">
                    <div class="container">
                        <div class="row">
                            <div class="custom-vehicle-details">
                                @include('livewire.suggested_vehicles.vehicles_list')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if($client_has_vehicles_with_downpayment)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-5xl font-extrabold text-center mt-1">
            <label class="block text-center items-center font-serif text-5xl mx-4 font-bold text-black leading uppercase">
                {{__("CAN'T FIND WHAT YOU ARE LOKING FOR?")}}
            </label>

            <div class="text-gray-400 text-xl text-center font-semibold">
                {{__('We have more vehicles in our inventory that require an additional down payment.')}}
            </div>
            <div class="text-gray-400 text-xl text-center font-semibold">
                {{__('Click view vehicles to unlock the prices.')}}
            </div>

            <div class="text-gray-500 text-xl text-center">
            <button class="bg-yellow-500
                            hover:bg-yellow-200
                            text-black font-bold py-2 px-4 border-4 hover:border-red-500 rounded"
                        wire:click="$toggle('show_garage')"
                        title="{{__('Show vehicles that require an additional down payment')}}">
                    {{ __('SHOW ME MORE')}}
            </button>
            </div>
        </div>
        @include('livewire.suggested_vehicles.amount_additional_downpayment')
    @endif

</div>
