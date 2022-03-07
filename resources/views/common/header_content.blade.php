<label class="block text-center items-center font-oswald text-5xl mx-4 font-semibold text-black leading uppercase">
    {{__($header_page)}}
</label>
<label class="block text-center items-center font-oswald text-2xl mx-4 font-semibold text-gray-600 leading ">
    @if($garage)
        @if($garage->has_space())
            {{__('You have') . '   ' . $garage->available_spaces()  . '   '.  __('spaces in your garage')}}
         @else
            {{__('Your Garage is Full')}}
        @endif
    @else
        {{__('You have') . '   ' . env('GARAGE_SPACES',3)  . '   '.  __('spaces in your garage')}}
    @endif
</label>
