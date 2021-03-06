<div class="max-w-screen-xl">
    <div class="mx-auto px-8 pb-4 py-4 w-full">
        <div class="items-center text-center align-center">
            <h2 class="mb-2 font-montserrat text-center text-black">
                {{__('There are no vehicles in your garage')}}
            </h2>
            <label class="mb-2 font-oswald text-black text-xl">
            </label>
            <div class="relative rounded-xl overflow-auto p-2 -mt-12">
                <div class="relative rounded-lg text-center overflow-hidden w-56 sm:w-96 mx-auto">
                    <div class="absolute inset-0 opacity-50 bg-stripes-gray"></div>
                    <img class="relative z-10 h-96 w-96 mx-auto" src="{{asset('images/coche.png')}}">
                </div>
            </div>
            <span class="mx-auto">
                <button class="btn_garage garage mx-auto mt-4" wire:click="return_to_approved">
                            {{ __('SEE INVENTORY')}}
                </button>
            </span>
        </div>
    </div>
</div>