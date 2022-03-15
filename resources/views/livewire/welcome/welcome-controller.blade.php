<div style="background-color: #6AB04C"
    class="body_background relative flex justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
    <div class="mx-auto block 2xl:-mt-12 sm:-mt-20 md:mt-1">
        <img  style="height:75%; width:75%;"  class="mx-auto" src="{{asset('images/welcome.png')}}">
            <button class="btn third mx-auto text-white">
                <a class="text-white font-semibold font-headline "
                @if($token)
                    href="{{ url('show_vehicles/'.$client_id . '/'.$token) }}">
                @else
                    href="{{ url('show_vehicles/'.$client_id) }}">
                @endif
                {{ __('UNLOCK PRICES')}}
                </a>
            </button>
    </div>
</div>
