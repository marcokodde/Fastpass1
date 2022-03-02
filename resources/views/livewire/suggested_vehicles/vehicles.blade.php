<div>
    @include('livewire.suggested_vehicles.index')
    <div class="sidemenu mt-12 w-64 absolute">
        @livewire('garages')
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mx-2 border border-gray-300">
                <div><label class="text-2xl text-gray-700">{{__('Session Expired in')}}</label> <span id="time" class="text-2xl text-red-500 bg-yellow-400 rounded-lg">05:00</span> minutes!</div>
            </div>
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <label class="block text-center items-center font-serif text-3xl mx-4 font-semibold text-black leading uppercase">{{__('Vehicles you are approved')}}</label>
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
    @livewire('additionalvehicles')
</div>
