<div wire:poll.keep-alive class="text-5xl text-bold">
    {{ __('The session will expire in')  }} : <span id="time" class="text-red-500 bg-yellow-400 rounded-lg">{{$time_remainder+1}} {{ __('Minutes')}}</span>
</div>

