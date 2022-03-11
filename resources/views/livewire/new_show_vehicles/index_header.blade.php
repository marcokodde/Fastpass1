<div class="flex left-0">
    <img class="stnd skip-lazy dark-version" width="207" height="110" alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
</div>
<div class="absolute right-0 top-0 flex items-center justify-center mb-4">
    @if($show_garage || $show_additional)
        <span class="relative inline-block sm:text-xs md:text-sm lg:text-lg">
            <button  wire:click="return_to_approved" title="{{__('Vehicles')}}">
                <img src="{{asset('images/apprved.png')}}" class="h-16 w-16 sm:h-16 sm:w-16 2xl:h-32 2xl:w-32 md:h-20 md:w-20">
            </button>
        </span>
    @endif
    <span class="relative inline-block mt-5 sm:mt-0 md:mt-0">
        <button wire:click="$toggle('show_garage')" title="{{__('Show My Garage')}}">
            <img src="{{asset('images/garage_new.png')}}" class="h-16 w-16 sm:h-20 sm:w-20 2xl:h-32 2xl:w-32 md:h-20 md:w-20">
        </button>
        @if($garage)
            <span class="absolute top-0 left-0 text-base rounded 2xl:top-28 2xl:left-12 sm:top-10 sm:left-0 md:top-10 md:left-0 inline-flex items-center justify-center 2xl:px-2 2xl:py-1 2xl:text-xl sm:text-base md:text-base font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 2xl:rounded-full">
                {{$garage->occupied_spaces()}}
            </span>
        @endif
    </span>
</div>
<hr class="border-2 border-gray-200 mx-4 mt-4">
@livewire('time-remainder')