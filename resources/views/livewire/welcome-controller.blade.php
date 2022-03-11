<div style="background-color: #6AB04C"
    class="body_background relative flex justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
    <div class="mx-auto block 2xl:-mt-32 mt-0 md:mt-1">
        <img class="h-4/5 w-4/5" src="{{asset('images/get_drive.png')}}">
            <button class="btn fourth mx-auto">
                <a class="text-black font-semibold font-headline "
                @if($token)
                    href="{{ url('show_vehicles/'.$client_id . '/'.$token) }}">
                @else
                    href="{{ url('show_vehicles/'.$client_id) }}">
                @endif
                {{ __('UNLOCK PRICES')}}
                </a>
            </button>

            {{--  <button class="btn first mx-auto">Button 1</button>
            <br>
            <p></p>
            <button class="btn second mx-auto">Button 2</button>
            <br>
            <p></p>
            <button class="btn third mx-auto">Button 3</button>  --}}
    </div>
</div>