<label class="block text-center items-center font-serif text-3xl mx-4 font-semibold text-black leading uppercase">
    {{__($header_page)}}
</label>
@if($garage)

    <label class="block text-center items-center font-serif text-2xl mx-4 font-semibold text-gray-600 leading ">
        @if($garage->has_space())
            {{__('You have') . '   ' . $garage->available_spaces()  . '   '.  __('spaces in your garage')}}
         @else
            {{__('Your Garage is Full')}}
        @endif

    </label>
@endif
