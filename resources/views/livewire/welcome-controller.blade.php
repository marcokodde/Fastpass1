<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="static">
            <img class="z-10 object-scale-down h-max w-max" src="{{asset('images/fondo.png')}}">
            <div class="absolute 2xl:top-80 2xl:left-96 md:top-20 md:left-32 sm:top-10 sm:left-10">
                <a class="bg-yellow-500 hover:text-white 2xl:ml-32 sm:ml-1
                text-black 2xl:text-2xl sm:text-base md:text-base font-bold sm:px-2 sm:p-1 sm:py-1 2xl:px-20 2xl:pb-4 2xl:py-4 rounded-lg"
                @if($token)
                        href="{{ url('show_vehicles/'.$client_id . '/'.$token) }}">
                    @else
                        href="{{ url('show_vehicles/'.$client_id) }}">
                    @endif
                    {{ __('UNLOCK PRICES')}}
                    </a>
            </div>
        </div>
    </div>
</div>
