<label class="block text-center items-center font-oswald text-4xl mx-4 font-semibold text-black leading uppercase mb-2">
    {{__($header_page)}}
</label>
<label class="block text-center items-center font-oswald text-xl mx-4 font-semibold text-gray-600 @if($header_second == 'These are vehicles you are eligible to purchase with additional down payment.')
    text-red-500
    @endif
leading mb-2">
    {{__($header_second)}}
</label>
<label class="block text-center items-center font-oswald text-2xl mx-4 px-4 font-semibold text-gray-600 leading">
    @if($garage && !$show_garage)
        @if($garage->has_space())
            {{__('You have') . '   ' . $garage->available_spaces()  . '   '.  __('spaces in your garage')}}
        @else
            {{__('Your Garage is Full')}}
        @endif
    @endif
</label>