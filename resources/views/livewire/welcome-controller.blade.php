<div style="background-color: #6ab04c"
    class="body_background relative flex justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
    <div class="mx-auto block 2xl:-mt-20 mt-0 md:mt-1">
        <img class="h-96 w-96" src="{{asset('images/get_drive.png')}}">
        <a style="background-color:chartreuse" class="text-black font-semibold font-headline mx-auto rounded-lg border-2 px-8 ml-20 mt-4 py-4 pb-4 items-center text-center transition ease-in duration-700 hover:bg-gray-400 hover:text-white"
        @if($token)
            href="{{ url('show_vehicles/'.$client_id . '/'.$token) }}">
        @else
            href="{{ url('show_vehicles/'.$client_id) }}">
        @endif
        {{ __('UNLOCK PRICES')}}
    </a>
    <br>
    <p></p>
    </div>
</div>
