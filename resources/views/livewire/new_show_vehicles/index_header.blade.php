<div class="flex justify-between ml-4 mr-10">
    <img class="stnd skip-lazy dark-version" width="207" height="110" alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
        @if($show_garage || $show_additional)
            <span class="relative inline-block mt-5">
                <button  wire:click="return_to_approved"
                        class=" hover:bg-gray-100 hover:text-gray-600 border border-blue-300
                                text-black font-bold py-2 px-4 rounded-lg">
                    {{ __('Inventory')}}
                </button>
            </span>
        @endif
        <div class="mx-2 mt-4 border border-gray-300">
            <div>
                @livewire('time-remainder')
            </div>
        </div>

        <span class="relative inline-block mt-5">
            <button wire:click="$toggle('show_garage')" title="{{__('Show My Garage')}}">
                <img src="{{asset('images/garage_icono.png')}}" height="60px" width="60px">

                    <span class="absolute top-16 right-0 inline-flex items-center justify-center px-2 py-1 text-xl font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                        {{$garage->occupied_spaces()}}
                    </span>

            </button>
        </span>

</div>
<hr class="border-2 border-gray-200 mx-4 ">
