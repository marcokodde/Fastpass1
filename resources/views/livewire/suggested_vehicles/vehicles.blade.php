<div>
    @include('livewire.suggested_vehicles.index')
    <div class="sidemenu mt-12 w-64 absolute">
        <div class="mb-2">
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
        </div>
        @livewire('garages')
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
        @include('livewire.suggested_vehicles.amount_additional_downpayment')
    @endif

</div>
