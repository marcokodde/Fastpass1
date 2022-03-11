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
<style type="text/css">
    .btn {
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: transparent;
        border: 2px solid #f1c40f;
        border-radius: 0.6em;
        color: #f1c40f;
        cursor: pointer;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-self: center;
            -ms-flex-item-align: center;
                align-self: center;
        font-size: 2rem;
        font-weight: 200;
        line-height: 1;
        margin-top: -40px;
        padding: 1em 1em;
        text-decoration: none;
        text-align: center;
        text-transform: uppercase;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
    }
    .btn:hover, .btn:focus {
        color: #fff;
        outline: 0;
    }

    .first {
        -webkit-transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out;
        transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out;
    }
    .first:hover {
        box-shadow: 0 0 40px 40px #f1c40f inset;
    }

    .second {
        border-radius: 3em;
        border-color: #f1c40f;
        color: #fff;
        background-image: -webkit-linear-gradient(left, rgba(26, 188, 156, 0.6), rgba(26, 188, 156, 0.6) 5%, #1abc9c 5%, #1abc9c 10%, rgba(26, 188, 156, 0.6) 10%, rgba(26, 188, 156, 0.6) 15%, #1abc9c 15%, #1abc9c 20%, rgba(26, 188, 156, 0.6) 20%, rgba(26, 188, 156, 0.6) 25%, #1abc9c 25%, #1abc9c 30%, rgba(26, 188, 156, 0.6) 30%, rgba(26, 188, 156, 0.6) 35%, #1abc9c 35%, #1abc9c 40%, rgba(26, 188, 156, 0.6) 40%, rgba(26, 188, 156, 0.6) 45%, #1abc9c 45%, #1abc9c 50%, rgba(26, 188, 156, 0.6) 50%, rgba(26, 188, 156, 0.6) 55%, #1abc9c 55%, #1abc9c 60%, rgba(26, 188, 156, 0.6) 60%, rgba(26, 188, 156, 0.6) 65%, #1abc9c 65%, #1abc9c 70%, rgba(26, 188, 156, 0.6) 70%, rgba(26, 188, 156, 0.6) 75%, #1abc9c 75%, #1abc9c 80%, rgba(26, 188, 156, 0.6) 80%, rgba(26, 188, 156, 0.6) 85%, #1abc9c 85%, #1abc9c 90%, rgba(26, 188, 156, 0.6) 90%, rgba(26, 188, 156, 0.6) 95%, #1abc9c 95%, #1abc9c 100%);
        background-image: linear-gradient(to right, rgba(26, 188, 156, 0.6), rgba(26, 188, 156, 0.6) 5%, #1abc9c 5%, #1abc9c 10%, rgba(26, 188, 156, 0.6) 10%, rgba(26, 188, 156, 0.6) 15%, #1abc9c 15%, #1abc9c 20%, rgba(26, 188, 156, 0.6) 20%, rgba(26, 188, 156, 0.6) 25%, #1abc9c 25%, #1abc9c 30%, rgba(26, 188, 156, 0.6) 30%, rgba(26, 188, 156, 0.6) 35%, #1abc9c 35%, #1abc9c 40%, rgba(26, 188, 156, 0.6) 40%, rgba(26, 188, 156, 0.6) 45%, #1abc9c 45%, #1abc9c 50%, rgba(26, 188, 156, 0.6) 50%, rgba(26, 188, 156, 0.6) 55%, #1abc9c 55%, #1abc9c 60%, rgba(26, 188, 156, 0.6) 60%, rgba(26, 188, 156, 0.6) 65%, #1abc9c 65%, #1abc9c 70%, rgba(26, 188, 156, 0.6) 70%, rgba(26, 188, 156, 0.6) 75%, #1abc9c 75%, #1abc9c 80%, rgba(26, 188, 156, 0.6) 80%, rgba(26, 188, 156, 0.6) 85%, #1abc9c 85%, #1abc9c 90%, rgba(26, 188, 156, 0.6) 90%, rgba(26, 188, 156, 0.6) 95%, #1abc9c 95%, #1abc9c 100%);
        background-position: 0 0;
        background-size: 100%;
        -webkit-transition: background 300ms ease-in-out;
        transition: background 300ms ease-in-out;
    }
    .second:hover {
        background-position: 100px;
    }

    .third {
        border-color: #f1c40f;
        color: #fff;
        box-shadow: 0 0 40px 40px #f1c40f inset, 0 0 0 0 #f1c40f;
        -webkit-transition: all 150ms ease-in-out;
        transition: all 150ms ease-in-out;
    }
    .third:hover {
        box-shadow: 0 0 10px 0 #f1c40f inset, 0 0 10px 4px #f1c40f;
    }

    .fourth {
        border-color: #f1c40f;
        color: #fff;
        background-image: -webkit-linear-gradient(45deg, #f1c40f 50%, transparent 50%);
        background-image: linear-gradient(45deg, #f1c40f 50%, transparent 50%);
        background-position: 100%;
        background-size: 400%;
        -webkit-transition: background 300ms ease-in-out;
        transition: background 300ms ease-in-out;
    }
    .fourth:hover {
        background-position: 0;
    }
</style>