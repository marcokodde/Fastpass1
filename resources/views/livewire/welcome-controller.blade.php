<div style="background-color: #6ab04c"
    class="body_background relative flex justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
    <div class="mx-auto block 2xl:-mt-20 mt-0 md:mt-1">
      <img class="h-96 w-96" src="{{asset('images/get_drive.png')}}">
    <button class="border-2 px-8 ml-20 mt-4 py-4 pb-4 items-center text-center">
        <a class="hover:text-black text-white font-bold mx-auto px-4 rounded-lg"
        @if($token)
            href="{{ url('show_vehicles/'.$client_id . '/'.$token) }}">
        @else
            href="{{ url('show_vehicles/'.$client_id) }}">
        @endif
        {{ __('UNLOCK PRICES')}}
    </a>
    </button>
    <br>
    <p></p>
    </div>
</div>
