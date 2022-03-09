<div class="flex left-0">
    <img class="stnd skip-lazy dark-version" width="207" height="110" alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
</div>
<div class="absolute right-0 top-0 flex items-center justify-center mb-4">
@if($show_garage || $show_additional)
            <span class="relative inline-block sm:text-xs md:text-sm lg:text-lg">
                <button  wire:click="return_to_approved" title="{{__('Vehicles')}}">
                    <img src="{{asset('images/apprved.png')}}" class="sm:h-20 sm:w-20 2xl:h-32 2xl:w-32 md:h-24 md:w-24">
                </button>
            </span>
        @endif
        <span class="relative inline-block mt-5">
            <button wire:click="$toggle('show_garage')" title="{{__('Show My Garage')}}">
                <img src="{{asset('images/garage_new.png')}}" class="sm:h-20 sm:w-20 2xl:h-32 2xl:w-32 md:h-24 md:w-24">
                @if($garage)
                    <span class="absolute top-18 -right-10 inline-flex text-xl font-bold leading-none transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                        {{$garage->occupied_spaces()}}
                    </span>
                @endif
            </button>
        </span>
</div>
<hr class="border-2 border-gray-200 mx-4 mt-4">
@livewire('time-remainder')