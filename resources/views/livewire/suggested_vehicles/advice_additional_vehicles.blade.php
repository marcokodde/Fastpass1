<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-5xl font-extrabold text-center mt-1">
    <label class="block text-center items-center font-serif text-5xl mx-4 font-bold text-black leading uppercase">
        {{__("CAN'T FIND WHAT YOU ARE LOKING FOR?")}}
    </label>

    <div class="text-gray-400 text-xl text-center font-semibold">
        {{__('We have more vehicles in our inventory that require an additional down payment.')}}
    </div>
    <div class="text-gray-400 text-xl text-center font-semibold">
        {{__('Click view vehicles to unlock the prices.')}}
    </div>

    <div class="text-gray-500 text-xl text-center">
    <button class="bg-yellow-500
                    hover:bg-yellow-200
                    text-black font-bold py-2 px-4 border-4 hover:border-red-500 rounded"
                wire:click="$toggle('show_garage')"
                title="{{__('Show vehicles that require an additional down payment')}}">
            {{ __('SHOW ME MORE')}}
    </button>
    </div>
</div>
