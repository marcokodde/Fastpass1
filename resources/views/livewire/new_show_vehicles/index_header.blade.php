<div class="flex left-0">
    <img class="stnd skip-lazy dark-version h-20 w-20 sm:h-20 sm:w-20 2xl:h-44 2xl:w-44 md:h-32 md:w-32" alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
</div>
<div class="absolute right-0 top-0 flex items-center justify-center mb-4">
@if($show_garage || $show_additional)
            <span class="relative inline-block sm:text-xs md:text-sm lg:text-lg">
                <button  wire:click="return_to_approved" title="{{__('Vehicles')}}">
                    <img src="{{asset('images/apprved.png')}}" class="h-16 w-16 sm:h-16 sm:w-16 2xl:h-32 2xl:w-32 md:h-20 md:w-20">
                </button>
            </span>
        @endif
        <span class="relative inline-block mt-5">
            <button wire:click="$toggle('show_garage')" title="{{__('Show My Garage')}}">
                <img src="{{asset('images/garage_new.png')}}" class="h-16 w-16 sm:h-20 sm:w-20 2xl:h-32 2xl:w-32 md:h-20 md:w-20">
                @if($garage)
                    <span class="top-10 left-0 inline-flex text-center text-lg font-bold transform translate-x-1/2 -translate-y-1/2 text-white bg-red-600 h-12 w-12 rounded-full">
                        {{$garage->occupied_spaces()}}
                    </span>
                @endif
            </button>
        </span>
</div>
<hr class="border-2 border-gray-200 mx-4 mt-4">
@livewire('time-remainder')
