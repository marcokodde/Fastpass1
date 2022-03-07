<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-5xl font-extrabold text-center mt-1">

    @if(!$show_additional && !$show_garage)
        <label class="block text-center items-center font-montserrat text-4xl mx-4 font-bold text-black leading uppercase">
            {{__("CAN'T FIND WHAT YOU ARE LOKING FOR?")}}
        </label>

        <div class="text-gray-500 text-2xl text-center font-oswald font-semibold mt-4">
            {{__('We have more vehicles in our inventory that require an additional down payment.')}}
        </div>
        <div class="text-gray-500 text-2xl text-center font-oswald font-semibold mt-4">
            {{__('Click view vehicles to unlock the prices.')}}
        </div>

        <div class="text-gray-500 text-xl text-center">
            <button style="background-color:#E3C116" class="hover:bg-yellow-500 hover:text-white
                           text-black text-2xl font-bold px-20 pb-4 py-4 rounded-lg"
                        wire:click="$toggle('show_additional')"
                        title="{{__('Show vehicles that require an additional down payment')}}">
                    {{ __('SHOW ME MORE')}}
            </button>
        </div>
    @endif


</div>
