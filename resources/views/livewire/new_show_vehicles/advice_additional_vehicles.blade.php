<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-5xl font-extrabold text-center mt-1">
    @if(!$show_additional && !$show_garage)
        <label class="block text-center items-center font-montserrat text-4xl mx-4 font-bold text-black leading uppercase">
            {{__("CAN'T FIND WHAT YOU ARE LOOKING FOR?")}}
        </label>

        <div class="text-gray-500 text-2xl text-center font-oswald font-semibold mt-4">
            {{__('We have more vehicles in our inventory that require an additional down payment.')}}
        </div>
        <div class="text-gray-500 text-2xl text-center font-oswald font-semibold mt-4">
            {{__('Click SHOW ME MORE to unlock the prices.')}}
        </div>

        <div class="w-96 mx-auto text-center 2xl:mt-8 mt-8 mb-16">
            <button style="background-color:#f1c40f" class="btn2 fourth mx-auto text-white"
                        wire:click="$toggle('show_additional')"
                        title="{{__('Show vehicles that require an additional down payment')}}">
                    {{ __('SHOW ME MORE')}}
            </button>
        </div>
    @endif
</div>