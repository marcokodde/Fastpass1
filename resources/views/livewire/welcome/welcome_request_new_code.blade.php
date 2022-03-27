<div style="background-color: #6AB04C">
    <img class="stnd skip-lazy dark-version" width="207" height="110" alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
    <div style="background-color: #6AB04C" class="relative flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="mx-auto block 2xl:-mt-44 mt-0 md:mt-1 sm:mt-0">
            <img style="height:70%; width:70%;" class="mx-auto" src="{{asset('images/bad_error.png')}}">
            <button wire:click.prevent="client_require_new_code({{$client}})" onclick="execute()"
                    style="background-color:#f1c40f" class="btn_reques_code mx-auto text-white hover:text-black">
                {{ __('REQUEST NEW CODE')}}
            </button>
        </div>
    </div>
</div>
<script>
    function execute() {
        Swal.fire({
            title: 'Good Job!, Let"s get you Driving!',
            width: 450,
            padding: '3em',
            width: 400,
            padding: 50,
            background: '#fff url(//bit.ly/1Nqn9HU)',
            color: '#fff',
            radius:'24px',
            backdrop: `rgba(0,0,123,0.4)
                url("/images/car_rotate.gif")
                top center
                no-repeat`
        })
    }
</script>