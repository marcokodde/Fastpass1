<div style="background-color: #6AB04C" class="body_background relative flex justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
    @if ($right_params)
        <div class="mx-auto block 2xl:-mt-12 sm:-mt-20 md:mt-1">
            <img  style="height:75%; width:75%;"  class="sm:h-72 sm:w-72 md:h-96 md:w-96 mx-auto object-scale-down" src="{{asset('images/welcome_home.png')}}">
            <button style="background-color:#f1c40f" class="btn mx-auto text-white">
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

    @elseif (!$right_params && $client && $client->session_with_token())
        @include('livewire.welcome.welcome_request_new_code')
    @else
        <div>
            <img class="mx-auto stnd skip-lazy dark-version" width="207" height="110" alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
            <div style="background-color: #6AB04C">
                <div style="background-color: #6AB04C" class="relative flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
                    <div class="mx-auto block 2xl:-mt-12 mt-0 md:mt-1">
                        <img class="h-4/5 w-4/5 mx-auto" src="{{asset('images/bad_error.png')}}">
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>