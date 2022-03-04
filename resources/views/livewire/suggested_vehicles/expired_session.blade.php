<div>
    @include('livewire.suggested_vehicles.index')
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
       </div>
    </div>
</div>
