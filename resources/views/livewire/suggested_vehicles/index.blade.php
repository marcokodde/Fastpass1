<div class="flex justify-between ml-4 mr-10">
    <img class="stnd skip-lazy dark-version" width="207" height="110" alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>

    @if($client && $allow_login)
        @if($show_garage || $show_additional)
            <span class="relative inline-block mt-5">
                <button style="background-color: #5CB352" wire:click="return_to_approved"
                        class=" hover:bg-green-600 hover:text-white
                                text-black font-bold py-2 px-4 rounded-lg">
                    {{ __('Vehicles you are approved')}}
                </button>
            </span>
        @endif

        <span class="relative inline-block mt-5">

            <button wire:click="$toggle('show_garage')" title="{{__('Show My Garage')}}">
                <img src="{{asset('images/garage_icono.png')}}" height="60px" width="60px">
                @if($garage)
                    <span class="absolute top-16 right-0 inline-flex items-center justify-center px-2 py-1 text-xl font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                        {{$garage->occupied_spaces()}}
                    </span>
                @endif
            </button>
        </span>
    @endif
</div>
<hr class="border-2 border-gray-200 mx-4 ">