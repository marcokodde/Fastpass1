<div style="background-color:#5CB352; heigth:150%; widht:120%;">
    <div class="mx-auto px-8 pb-4 py-4">
        <div class="items-center text-center align-center">
            <h2 class="mb-2 font-montserrat text-center text-white">
                {{__('There are no vehicles in your garage')}}
            </h2>
            <label class="mb-2 font-oswald text-white text-xl">
                {{__('Browse our inventory to add your next vehicle !!')}}
            </label>
            <div class="relative rounded-xl overflow-auto p-2 -mt-12">
                <div class="relative rounded-lg text-center overflow-hidden w-56 sm:w-96 mx-auto">
                    <div class="absolute inset-0 opacity-50 bg-stripes-gray"></div>
                    <img class="relative z-10 object-scale-down h-full w-full" src="{{asset('images/coche.png')}}">
                </div>
            </div>
            <span class="mx-auto">
                <button class="btn fourth mx-auto" wire:click="return_to_approved">
                            {{ __('SEE INVENTORY')}}
                </button>
            </span>
        </div>
    </div>
</div>