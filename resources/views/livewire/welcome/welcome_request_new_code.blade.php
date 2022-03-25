{{-- <div class="mx-auto block 2xl:-mt-12 sm:-mt-20 md:mt-1">
    <img class="stnd skip-lazy dark-version" width="207" height="110" alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
    <button wire:click="client_require_new_code({{$client}})"
            style="background-color:#f1c40f" class="btn mx-auto text-black">
        {{ __('REQUEST NEW CODE')}}

    </button>
</div> --}}


<div style="background-color: #6AB04C">
    <img class="stnd skip-lazy dark-version" width="207" height="110" alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
    <div style="background-color: #6AB04C" class="relative flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="mx-auto block 2xl:-mt-12 mt-0 md:mt-1">
            <img class="h-4/5 w-4/5 mx-auto" src="{{asset('images/bad_error.png')}}">
            <button wire:click.prevent="client_require_new_code({{$client}})"
                    style="background-color:#f1c40f" class="btn mx-auto text-white">
                {{ __('REQUEST NEW CODE')}}
            </button>
        </div>
    </div>
</div>
