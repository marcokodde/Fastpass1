<div wire:poll.keep-alive class="text-5xl text-bold">
    <img class="inline" src="{{ asset('images/timer.png') }}" alt="">
    <span id="time" class="inline text-black rounded-lg">{{$time_remainder+1}} {{ __('Minutes')}}</span>
</div>