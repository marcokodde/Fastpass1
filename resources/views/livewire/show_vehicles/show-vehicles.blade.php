<div>
    @include('livewire.show_vehicles.index')
    <div class="sidemenu mt-12 w-64 absolute">
    </div>
    <div class="py-2 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg mt-2">
                @include('common.header_content')
                @if($show_additional && !$show_garage)
                    @include('livewire.show_vehicles.amount_additional_downpayment')
                @endif
                <div class="body_container mt-2">
                    <div class="container">
                        <div class="row relative">
                            <div class="custom-vehicle-details relative">
                                @if(isset($records) && $records->count())
                                    @include('livewire.show_vehicles.vehicles_list')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.show_vehicles.advice_additional_vehicles')
        @if($garage && !$garage->vehicles_in_garages()->count())
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
